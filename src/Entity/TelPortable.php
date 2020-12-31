<?php

namespace App\Entity;

use App\Repository\TelPortableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelPortableRepository::class)
 */
class TelPortable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Numero;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="telPortables")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=TelPortablePrefix::class, inversedBy="TelPortable")
     */
    private $telPortablePrefix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getTelPortablePrefix(): ?TelPortablePrefix
    {
        return $this->telPortablePrefix;
    }

    public function setTelPortablePrefix(?TelPortablePrefix $telPortablePrefix): self
    {
        $this->telPortablePrefix = $telPortablePrefix;

        return $this;
    }
}
