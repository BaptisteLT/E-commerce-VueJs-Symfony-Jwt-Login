<?php

namespace App\Entity;

use App\Repository\TelFixPrefixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelFixPrefixRepository::class)
 */
class TelFixPrefix
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
    private $Prefix;

    /**
     * @ORM\OneToMany(targetEntity=TelFixe::class, mappedBy="telFixPrefix")
     */
    private $TelFixe;

    public function __construct()
    {
        $this->TelFixe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrefix(): ?int
    {
        return $this->Prefix;
    }

    public function setPrefix(int $Prefix): self
    {
        $this->Prefix = $Prefix;

        return $this;
    }

    /**
     * @return Collection|TelFixe[]
     */
    public function getTelFixe(): Collection
    {
        return $this->TelFixe;
    }

    public function addTelFixe(TelFixe $telFixe): self
    {
        if (!$this->TelFixe->contains($telFixe)) {
            $this->TelFixe[] = $telFixe;
            $telFixe->setTelFixPrefix($this);
        }

        return $this;
    }

    public function removeTelFixe(TelFixe $telFixe): self
    {
        if ($this->TelFixe->contains($telFixe)) {
            $this->TelFixe->removeElement($telFixe);
            // set the owning side to null (unless already changed)
            if ($telFixe->getTelFixPrefix() === $this) {
                $telFixe->setTelFixPrefix(null);
            }
        }

        return $this;
    }
}
