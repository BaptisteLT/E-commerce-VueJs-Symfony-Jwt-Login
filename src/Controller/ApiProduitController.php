<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\TypeProduit;
use App\Service\FileUploader;
use App\Entity\CollectionProduit;
use Doctrine\ORM\EntityManagerInterface;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiProduitController extends ApiController
{
    /**
     * @Route("/produit", name="api_produit", methods={"GET"})
     * 
     */
    public function index(Request $request,PaginatorInterface $paginator, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(Produit::class)->findAllProductsHomePageQuery();

        $data = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1),
            10 /*limit per page*/
        );

        $encoders=[new JsonEncoder()];
        $normalizers=[new ObjectNormalizer()];
        $serializer=new Serializer($normalizers,$encoders);

        $array=[];
        array_push($array, $data);
        array_push($array, ['lastPage'=>(ceil( $data->getTotalItemCount()/$data->getItemNumberPerPage()) )]); //Récup le nombre de pages. Ceil va arrondir au nombre supérieur, et getTotalItemCount va récupérer le nombre total d'items qu'on va diviser par le nombre d'items par page, si on a 13 items, la valeur sera 1.3, puis transformée à 2 grâce à ceil.
        $dataJson = $serializer->serialize($array, 'json');

        
        $response = new Response($dataJson);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/userinfos", name="api_userinfos", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function infoUser(Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findAll();

        $response = new Response(json_encode($produits));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/postproduit", name="api_postproduit", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function postProduit(Request $request, EntityManagerInterface $em, FileUploader $fileUploader)
    {
        if ($request->request->get('collection') && $request->request->get('type') && $request->request->get('titre')&& $request->request->get('prix') && $request->files->get('myFile'))
        {
            $titre = $request->request->get('titre'); 
            $file = $request->files->get('myFile'); 
            $collectionId = $request->request->get('collection'); 
            $typeId = $request->request->get('type'); 
            $prix = $request->request->get('prix'); 
        }
        else
        {
            return $this->respondValidationError();
        }

        $repositoryTypeProduit = $this->getDoctrine()->getRepository(TypeProduit::class);
        $repositoryCollectionProduit = $this->getDoctrine()->getRepository(CollectionProduit::class);

        // look for a single TypeProduit by its primary key (usually "id")
        $TypeProduit = $repositoryTypeProduit->find($typeId);

        // look for a single CollectionProduit by its primary key (usually "id")
        $CollectionProduit = $repositoryCollectionProduit->find($collectionId);


        $produit = new Produit();//Créer l'objet vierge

        $imageFileName =$fileUploader->upload($file);//On upload avec le service FileUploader
        $produit->setImageFilename($imageFileName);        //On ajoute à l'objet
        $produit->setNom($titre);                          //
        $produit->setTypeProduit($TypeProduit);            // 
        $produit->setCollectionProduit($CollectionProduit);//
        $produit->setPrix($prix);// 

        

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($produit);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return $this->respondCreated(sprintf('Product added')); //Réponse 201
    }


    /**
     * @Route("/api/getcollectiontypeproduit", name="api_getCollectionTypeProduit", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function getCollectionTypeProduit()
    {
        $repositoryTypeProduit = $this->getDoctrine()->getRepository(TypeProduit::class);
        $TypeProduit = $repositoryTypeProduit->findAllCustom();//CREER UN CUSTOM SELECT DE ID ET Nom SEULEMENT

        $repositoryCollectionProduit = $this->getDoctrine()->getRepository(CollectionProduit::class);
        $CollectionProduit = $repositoryCollectionProduit->findAllCustom();//CREER UN CUSTOM SELECT DE ID ET nom SEULEMENT



        $encoders=[new JsonEncoder()];
        $normalizers=[new ObjectNormalizer()];
        $serializer=new Serializer($normalizers,$encoders);

        $jsonContentTypeProduit=$serializer->serialize($TypeProduit,'json',[
            'circular_reference_handler'=>function($object){
                return $object->getId();
            }
        ]);

        $jsonContentCollectionProduit=$serializer->serialize($CollectionProduit,'json',[
            'circular_reference_handler'=>function($object){
                return $object->getId();
            }
        ]);

        $jsonContent = [];
        array_push($jsonContent, $jsonContentCollectionProduit, $jsonContentTypeProduit);


        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
