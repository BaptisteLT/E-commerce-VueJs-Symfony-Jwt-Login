<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="ProduitsAime")
     */
    private $ClientAime;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueAchat::class, mappedBy="Produit")
     */
    private $historiqueAchats;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class, inversedBy="Produit")
     */
    private $typeProduit;

    /**
     * @ORM\OneToMany(targetEntity=ColorisProduit::class, mappedBy="Produit", orphanRemoval=true)
     */
    private $colorisProduits;

    /**
     * @ORM\ManyToOne(targetEntity=CollectionProduit::class, inversedBy="Produit")
     */
    private $collectionProduit;

    /**
     * @ORM\Column(type="string")
     */
    private $imageFilename;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;


    public function __construct()
    {
        $this->ClientAime = new ArrayCollection();
        $this->historiqueAchats = new ArrayCollection();
        $this->colorisProduits = new ArrayCollection();
    }

    public function getImageFilename()
    {
        return $this->imageFilename;
    }

    public function setImageFilename($imageFilename)
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getClientAime(): Collection
    {
        return $this->ClientAime;
    }

    public function addClientAime(User $clientAime): self
    {
        if (!$this->ClientAime->contains($clientAime)) {
            $this->ClientAime[] = $clientAime;
        }

        return $this;
    }

    public function removeClientAime(User $clientAime): self
    {
        if ($this->ClientAime->contains($clientAime)) {
            $this->ClientAime->removeElement($clientAime);
        }

        return $this;
    }

    /**
     * @return Collection|HistoriqueAchat[]
     */
    public function getHistoriqueAchats(): Collection
    {
        return $this->historiqueAchats;
    }

    public function addHistoriqueAchat(HistoriqueAchat $historiqueAchat): self
    {
        if (!$this->historiqueAchats->contains($historiqueAchat)) {
            $this->historiqueAchats[] = $historiqueAchat;
            $historiqueAchat->setProduit($this);
        }

        return $this;
    }

    public function removeHistoriqueAchat(HistoriqueAchat $historiqueAchat): self
    {
        if ($this->historiqueAchats->contains($historiqueAchat)) {
            $this->historiqueAchats->removeElement($historiqueAchat);
            // set the owning side to null (unless already changed)
            if ($historiqueAchat->getProduit() === $this) {
                $historiqueAchat->setProduit(null);
            }
        }

        return $this;
    }

    public function getTypeProduit(): ?TypeProduit
    {
        return $this->typeProduit;
    }

    public function setTypeProduit(?TypeProduit $typeProduit): self
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    /**
     * @return Collection|ColorisProduit[]
     */
    public function getColorisProduits(): Collection
    {
        return $this->colorisProduits;
    }

    public function addColorisProduit(ColorisProduit $colorisProduit): self
    {
        if (!$this->colorisProduits->contains($colorisProduit)) {
            $this->colorisProduits[] = $colorisProduit;
            $colorisProduit->setProduit($this);
        }

        return $this;
    }

    public function removeColorisProduit(ColorisProduit $colorisProduit): self
    {
        if ($this->colorisProduits->contains($colorisProduit)) {
            $this->colorisProduits->removeElement($colorisProduit);
            // set the owning side to null (unless already changed)
            if ($colorisProduit->getProduit() === $this) {
                $colorisProduit->setProduit(null);
            }
        }

        return $this;
    }

    public function getCollectionProduit(): ?CollectionProduit
    {
        return $this->collectionProduit;
    }

    public function setCollectionProduit(?CollectionProduit $collectionProduit): self
    {
        $this->collectionProduit = $collectionProduit;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }



}
