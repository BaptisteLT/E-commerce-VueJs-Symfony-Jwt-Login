<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $NomPrenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseLigne1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AdresseLigne2;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EtatProvinceRegion;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $CodePostal;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Instructions;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $CodeAcces;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Pays;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPrenom(): ?string
    {
        return $this->NomPrenom;
    }

    public function setNomPrenom(string $NomPrenom): self
    {
        $this->NomPrenom = $NomPrenom;

        return $this;
    }

    public function getAdresseLigne1(): ?string
    {
        return $this->AdresseLigne1;
    }

    public function setAdresseLigne1(string $AdresseLigne1): self
    {
        $this->AdresseLigne1 = $AdresseLigne1;

        return $this;
    }

    public function getAdresseLigne2(): ?string
    {
        return $this->AdresseLigne2;
    }

    public function setAdresseLigne2(?string $AdresseLigne2): self
    {
        $this->AdresseLigne2 = $AdresseLigne2;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getEtatProvinceRegion(): ?string
    {
        return $this->EtatProvinceRegion;
    }

    public function setEtatProvinceRegion(string $EtatProvinceRegion): self
    {
        $this->EtatProvinceRegion = $EtatProvinceRegion;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(string $CodePostal): self
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->Instructions;
    }

    public function setInstructions(?string $Instructions): self
    {
        $this->Instructions = $Instructions;

        return $this;
    }

    public function getCodeAcces(): ?string
    {
        return $this->CodeAcces;
    }

    public function setCodeAcces(?string $CodeAcces): self
    {
        $this->CodeAcces = $CodeAcces;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->Pays;
    }

    public function setPays(?Pays $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }




}
