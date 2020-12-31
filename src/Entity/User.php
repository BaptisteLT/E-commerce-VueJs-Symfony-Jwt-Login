<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $LastName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateCreation;

    /**
     * @ORM\OneToMany(targetEntity=TelFixe::class, mappedBy="User")
     */
    private $telFixes;

    /**
     * @ORM\OneToMany(targetEntity=TelPortable::class, mappedBy="User")
     */
    private $telPortables;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, mappedBy="ClientAime")
     */
    private $ProduitsAime;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueAchat::class, mappedBy="Client")
     */
    private $historiqueAchats;

    public function __construct()
    {
        $this->telFixes = new ArrayCollection();
        $this->telPortables = new ArrayCollection();
        $this->ProduitsAime = new ArrayCollection();
        $this->historiqueAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }


    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    /**
     * @return Collection|TelFixe[]
     */
    public function getTelFixes(): Collection
    {
        return $this->telFixes;
    }

    public function addTelFix(TelFixe $telFix): self
    {
        if (!$this->telFixes->contains($telFix)) {
            $this->telFixes[] = $telFix;
            $telFix->setUser($this);
        }

        return $this;
    }

    public function removeTelFix(TelFixe $telFix): self
    {
        if ($this->telFixes->contains($telFix)) {
            $this->telFixes->removeElement($telFix);
            // set the owning side to null (unless already changed)
            if ($telFix->getUser() === $this) {
                $telFix->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TelPortable[]
     */
    public function getTelPortables(): Collection
    {
        return $this->telPortables;
    }

    public function addTelPortable(TelPortable $telPortable): self
    {
        if (!$this->telPortables->contains($telPortable)) {
            $this->telPortables[] = $telPortable;
            $telPortable->setUser($this);
        }

        return $this;
    }

    public function removeTelPortable(TelPortable $telPortable): self
    {
        if ($this->telPortables->contains($telPortable)) {
            $this->telPortables->removeElement($telPortable);
            // set the owning side to null (unless already changed)
            if ($telPortable->getUser() === $this) {
                $telPortable->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitsAime(): Collection
    {
        return $this->ProduitsAime;
    }

    public function addProduitsAime(Produit $produitsAime): self
    {
        if (!$this->ProduitsAime->contains($produitsAime)) {
            $this->ProduitsAime[] = $produitsAime;
            $produitsAime->addClientAime($this);
        }

        return $this;
    }

    public function removeProduitsAime(Produit $produitsAime): self
    {
        if ($this->ProduitsAime->contains($produitsAime)) {
            $this->ProduitsAime->removeElement($produitsAime);
            $produitsAime->removeClientAime($this);
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
            $historiqueAchat->setClient($this);
        }

        return $this;
    }

    public function removeHistoriqueAchat(HistoriqueAchat $historiqueAchat): self
    {
        if ($this->historiqueAchats->contains($historiqueAchat)) {
            $this->historiqueAchats->removeElement($historiqueAchat);
            // set the owning side to null (unless already changed)
            if ($historiqueAchat->getClient() === $this) {
                $historiqueAchat->setClient(null);
            }
        }

        return $this;
    }
}
