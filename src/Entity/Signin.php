<?php

namespace App\Entity;

use App\Repository\SigninRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SigninRepository::class)]
class Signin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $timestart = null;

    #[ORM\Column(length: 255)]
    private ?string $timestop = null;

    #[ORM\Column(length: 255)]
    private ?string $timefinish = null;

    #[ORM\Column(length: 255)]
    private ?string $hourcount = null;

    #[ORM\OneToMany(mappedBy: 'signin', targetEntity: Personal::class)]
    private Collection $personals;

    #[ORM\ManyToMany(targetEntity: Holidays::class, inversedBy: 'signins')]
    private Collection $holidays;

    #[ORM\ManyToMany(targetEntity: Workshops::class, inversedBy: 'signins')]
    private Collection $workshops;

    public function __construct()
    {
        $this->personals = new ArrayCollection();
        $this->holidays = new ArrayCollection();
        $this->workshops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestart(): ?string
    {
        return $this->timestart;
    }

    public function setTimestart(string $timestart): self
    {
        $this->timestart = $timestart;

        return $this;
    }

    public function getTimestop(): ?string
    {
        return $this->timestop;
    }

    public function setTimestop(string $timestop): self
    {
        $this->timestop = $timestop;

        return $this;
    }

    public function getTimefinish(): ?string
    {
        return $this->timefinish;
    }

    public function setTimefinish(string $timefinish): self
    {
        $this->timefinish = $timefinish;

        return $this;
    }

    public function getHourcount(): ?string
    {
        return $this->hourcount;
    }

    public function setHourcount(string $hourcount): self
    {
        $this->hourcount = $hourcount;

        return $this;
    }

    /**
     * @return Collection<int, Personal>
     */
    public function getPersonals(): Collection
    {
        return $this->personals;
    }

    public function addPersonal(Personal $personal): self
    {
        if (!$this->personals->contains($personal)) {
            $this->personals->add($personal);
            $personal->setSignin($this);
        }

        return $this;
    }

    public function removePersonal(Personal $personal): self
    {
        if ($this->personals->removeElement($personal)) {
            // set the owning side to null (unless already changed)
            if ($personal->getSignin() === $this) {
                $personal->setSignin(null);
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
        }

        return $this;
    }

    public function removeHoliday(Holidays $holiday): self
    {
        $this->holidays->removeElement($holiday);

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
        }

        return $this;
    }

    public function removeWorkshop(Workshops $workshop): self
    {
        $this->workshops->removeElement($workshop);

        return $this;
    }
    
}
