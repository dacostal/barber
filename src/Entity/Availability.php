<?php

namespace App\Entity;

use App\Repository\AvailabilityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailabilityRepository::class)
 */
class Availability
{
<<<<<<< HEAD
    const LUNDI = 1;
    const MARDI = 2;
    const MERCREDI = 3;
    const JEUDI = 4;
    const VENDREDI = 5;
    const SAMEDI = 6;

    const MATIN = 'Matin';
    const APRES_MIDI = 'Après-midi';

=======
    //enum bdd day
    const DAY = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
    //enum bdd Time of day
    const TIME_OF_DAY = array("Matin","Après-midi");
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28
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
     * @ORM\ManyToOne(targetEntity=Barber::class, inversedBy="availabilities")
     * @ORM\JoinColumn(nullable=false)
     */
<<<<<<< HEAD
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
=======
    private $barber;
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28

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

    public function getBarber(): ?Barber
    {
        return $this->barber;
    }

    public function setBarber(?Barber $barber): self
    {
        $this->barber = $barber;

        return $this;
    }
<<<<<<< HEAD

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


=======
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28
}
