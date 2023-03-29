<?php

namespace App\Entity;

use App\Repository\PersonalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalRepository::class)]
class Personal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surName = null;

    #[ORM\Column(length: 255)]
    private ?string $workshops = null;

    #[ORM\Column(length: 255)]
    private ?string $signIn = null;

    #[ORM\Column(length: 255)]
    private ?string $holidays = null;

    #[ORM\Column(length: 255)]
    private ?string $documents = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

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

    public function getSurName(): ?string
    {
        return $this->surName;
    }

    public function setSurName(string $surName): self
    {
        $this->surName = $surName;

        return $this;
    }

    public function getWorkshops(): ?string
    {
        return $this->workshops;
    }

    public function setWorkshops(string $workshops): self
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function getSignIn(): ?string
    {
        return $this->signIn;
    }

    public function setSignIn(string $signIn): self
    {
        $this->signIn = $signIn;

        return $this;
    }

    public function getHolidays(): ?string
    {
        return $this->holidays;
    }

    public function setHolidays(string $holidays): self
    {
        $this->holidays = $holidays;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(string $documents): self
    {
        $this->documents = $documents;

        return $this;
    }
}
