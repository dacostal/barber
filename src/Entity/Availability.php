<?php

namespace App\Entity;

use App\Repository\AvailabilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailabilityRepository::class)
 */
class Availability
{
    //enum bdd day
    const DAY = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
    //enum bdd Time of day
    const TIME_OF_DAY = array("Matin","Après-midi");

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $startTime;

    /**
     * @ORM\Column(type="time")
     */
    private $endTime;

    /**
     * @ORM\ManyToMany(targetEntity=Barber::class, mappedBy="availabilities")
     */
    private $barbers;

    public function __construct()
    {
        $this->barbers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @return Collection|Barber[]
     */
    public function getBarbers(): Collection
    {
        return $this->barbers;
    }

    public function addBarber(Barber $barber): self
    {
        if (!$this->barbers->contains($barber)) {
            $this->barbers[] = $barber;
            $barber->addAvailability($this);
        }

        return $this;
    }

    public function removeBarber(Barber $barber): self
    {
        if ($this->barbers->removeElement($barber)) {
            $barber->removeAvailability($this);
        }

        return $this;
    }


}
