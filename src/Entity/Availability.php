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
    const LUNDI = 1;
    const MARDI = 2;
    const MERCREDI = 3;
    const JEUDI = 4;
    const VENDREDI = 5;
    const SAMEDI = 6;

    const MATIN = 'Matin';
    const APRES_MIDI = 'Après-midi';

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

    /**
     * @ORM\ManyToMany(targetEntity=Appointment::class, mappedBy="availabilities")
     */
    private $appointments;

    /**
     * @ORM\Column(type="integer")
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timeOfDay;

    public function __construct()
    {
        $this->barbers = new ArrayCollection();
        $this->appointments = new ArrayCollection();
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

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->addAvailability($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            $appointment->removeAvailability($this);
        }

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        if (!in_array($day, array(self::LUNDI, self::MARDI,self::MERCREDI,self::JEUDI,self::VENDREDI,self::SAMEDI,))) {
            throw new \InvalidArgumentException("Invalid day");
        }
        $this->day = $day;

        return $this;
    }

    public function getTimeOfDay(): ?string
    {
        return $this->timeOfDay;
    }

    public function setTimeOfDay(string $timeOfDay): self
    {
        if (!in_array($timeOfDay, array(self::MATIN, self::APRES_MIDI))) {
            throw new \InvalidArgumentException("Invalid time of day");
        }
        $this->timeOfDay = $timeOfDay;

        return $this;
    }


}
