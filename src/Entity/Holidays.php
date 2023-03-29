<?php

namespace App\Entity;

use App\Repository\HolidaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HolidaysRepository::class)]
class Holidays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'holidays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personal $personal = null;

    #[ORM\ManyToMany(targetEntity: Signin::class, mappedBy: 'holidays')]
    private Collection $signins;

    public function __construct()
    {
        $this->signins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

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
            $signin->addHoliday($this);
        }

        return $this;
    }

    public function removeSignin(Signin $signin): self
    {
        if ($this->signins->removeElement($signin)) {
            $signin->removeHoliday($this);
        }

        return $this;
    }
}
