<?php

namespace App\Entity;

use App\Repository\TelFixeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelFixeRepository::class)
 */
class TelFixe
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="telFixes")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=TelFixPrefix::class, inversedBy="TelFixe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $telFixPrefix;

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

    public function getTelFixPrefix(): ?TelFixPrefix
    {
        return $this->telFixPrefix;
    }

    public function setTelFixPrefix(?TelFixPrefix $telFixPrefix): self
    {
        $this->telFixPrefix = $telFixPrefix;

        return $this;
    }
}
