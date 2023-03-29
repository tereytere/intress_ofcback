<?php

namespace App\Entity;

use App\Repository\PersonalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalRepository::class)]
class Personal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $rol = null;

    #[ORM\OneToMany(mappedBy: 'personal', targetEntity: Signin::class)]
    private Collection $signin;

    #[ORM\OneToMany(mappedBy: 'personal', targetEntity: Holidays::class)]
    private Collection $holidays;

    #[ORM\OneToMany(mappedBy: 'personal', targetEntity: Workshops::class)]
    private Collection $workshops;

    #[ORM\OneToMany(mappedBy: 'personal', targetEntity: Documents::class)]
    private Collection $documents;

    public function __construct()
    {
        $this->signin = new ArrayCollection();
        $this->holidays = new ArrayCollection();
        $this->workshops = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection<int, Signin>
     */
    public function getSignin(): Collection
    {
        return $this->signin;
    }

    public function addSignin(Signin $signin): self
    {
        if (!$this->signin->contains($signin)) {
            $this->signin->add($signin);
            $signin->setPersonal($this);
        }

        return $this;
    }

    public function removeSignin(Signin $signin): self
    {
        if ($this->signin->removeElement($signin)) {
            // set the owning side to null (unless already changed)
            if ($signin->getPersonal() === $this) {
                $signin->setPersonal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Holidays>
     */
    public function getHolidays(): Collection
    {
        return $this->holidays;
    }

    public function addHoliday(Holidays $holiday): self
    {
        if (!$this->holidays->contains($holiday)) {
            $this->holidays->add($holiday);
            $holiday->setPersonal($this);
        }

        return $this;
    }

    public function removeHoliday(Holidays $holiday): self
    {
        if ($this->holidays->removeElement($holiday)) {
            // set the owning side to null (unless already changed)
            if ($holiday->getPersonal() === $this) {
                $holiday->setPersonal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Workshops>
     */
    public function getWorkshops(): Collection
    {
        return $this->workshops;
    }

    public function addWorkshop(Workshops $workshop): self
    {
        if (!$this->workshops->contains($workshop)) {
            $this->workshops->add($workshop);
            $workshop->setPersonal($this);
        }

        return $this;
    }

    public function removeWorkshop(Workshops $workshop): self
    {
        if ($this->workshops->removeElement($workshop)) {
            // set the owning side to null (unless already changed)
            if ($workshop->getPersonal() === $this) {
                $workshop->setPersonal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setPersonal($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getPersonal() === $this) {
                $document->setPersonal(null);
            }
        }

        return $this;
    }
}
