<?php

namespace App\Entity;

use App\Repository\SigninRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SigninRepository::class)]
class Signin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $holidays = null;

    #[ORM\Column(length: 255)]
    private ?string $workshops = null;

    #[ORM\Column(length: 255)]
    private ?string $user = null;

    #[ORM\Column(length: 255)]
    private ?string $timeStart = null;

    #[ORM\Column(length: 255)]
    private ?string $timeStop = null;

    #[ORM\Column(length: 255)]
    private ?string $timeFinish = null;

    #[ORM\Column(length: 255)]
    private ?string $hourCount = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWorkshops(): ?string
    {
        return $this->workshops;
    }

    public function setWorkshops(string $workshops): self
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTimeStart(): ?string
    {
        return $this->timeStart;
    }

    public function setTimeStart(string $timeStart): self
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    public function getTimeStop(): ?string
    {
        return $this->timeStop;
    }

    public function setTimeStop(string $timeStop): self
    {
        $this->timeStop = $timeStop;

        return $this;
    }

    public function getTimeFinish(): ?string
    {
        return $this->timeFinish;
    }

    public function setTimeFinish(string $timeFinish): self
    {
        $this->timeFinish = $timeFinish;

        return $this;
    }

    public function getHourCount(): ?string
    {
        return $this->hourCount;
    }

    public function setHourCount(string $hourCount): self
    {
        $this->hourCount = $hourCount;

        return $this;
    }
}
