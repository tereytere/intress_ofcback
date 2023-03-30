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

    #[ORM\ManyToOne(inversedBy: 'personals')]
    private ?Workshops $workshops = null;

    #[ORM\ManyToOne(inversedBy: 'personals')]
    private ?Signin $signin = null;

    #[ORM\ManyToOne(inversedBy: 'personals')]
    private ?Holidays $holidays = null;

    #[ORM\ManyToOne(inversedBy: 'personals')]
    private ?Documents $documents = null;

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
    public function __toString()
    {
        return $this->getName();
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

    public function getWorkshops(): ?Workshops
    {
        return $this->workshops;
    }

    public function setWorkshops(?Workshops $workshops): self
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function getSignin(): ?Signin
    {
        return $this->signin;
    }

    public function setSignin(?Signin $signin): self
    {
        $this->signin = $signin;

        return $this;
    }

    public function getHolidays(): ?Holidays
    {
        return $this->holidays;
    }

    public function setHolidays(?Holidays $holidays): self
    {
        $this->holidays = $holidays;

        return $this;
    }

    public function getDocuments(): ?Documents
    {
        return $this->documents;
    }

    public function setDocuments(?Documents $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

}
