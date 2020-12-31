<?php

namespace App\Entity;

use App\Repository\TelPortablePrefixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelPortablePrefixRepository::class)
 */
class TelPortablePrefix
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
     * @ORM\OneToMany(targetEntity=TelPortable::class, mappedBy="telPortablePrefix")
     */
    private $TelPortable;

    public function __construct()
    {
        $this->TelPortable = new ArrayCollection();
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
     * @return Collection|TelPortable[]
     */
    public function getTelPortable(): Collection
    {
        return $this->TelPortable;
    }

    public function addTelPortable(TelPortable $telPortable): self
    {
        if (!$this->TelPortable->contains($telPortable)) {
            $this->TelPortable[] = $telPortable;
            $telPortable->setTelPortablePrefix($this);
        }

        return $this;
    }

    public function removeTelPortable(TelPortable $telPortable): self
    {
        if ($this->TelPortable->contains($telPortable)) {
            $this->TelPortable->removeElement($telPortable);
            // set the owning side to null (unless already changed)
            if ($telPortable->getTelPortablePrefix() === $this) {
                $telPortable->setTelPortablePrefix(null);
            }
        }

        return $this;
    }
}
