<?php

namespace App\Entity;

use App\Repository\WorkshopsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkshopsRepository::class)]
class Workshops
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    #[ORM\ManyToOne(inversedBy: 'workshops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personal $personal = null;

    #[ORM\ManyToMany(targetEntity: Signin::class, mappedBy: 'workshops')]
    private Collection $signins;

    public function __construct()
    {
        $this->signins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getPersonal(): ?Personal
    {
        return $this->personal;
    }

    public function setPersonal(?Personal $personal): self
    {
        $this->personal = $personal;

        return $this;
    }

    /**
     * @return Collection<int, Signin>
     */
    public function getSignins(): Collection
    {
        return $this->signins;
    }

    public function addSignin(Signin $signin): self
    {
        if (!$this->signins->contains($signin)) {
            $this->signins->add($signin);
            $signin->addWorkshop($this);
        }

        return $this;
    }

    public function removeSignin(Signin $signin): self
    {
        if ($this->signins->removeElement($signin)) {
            $signin->removeWorkshop($this);
        }

        return $this;
    }
}
