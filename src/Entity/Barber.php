<?php

namespace App\Entity;

use App\Repository\BarberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BarberRepository::class)
 *
 */

class Barber extends User
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
<<<<<<< HEAD
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="barber",cascade={"remove"})
     *
=======
     * @ORM\OneToMany(targetEntity=appointment::class, mappedBy="barber")
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28
     */
    private $appointments;

    /**
<<<<<<< HEAD
     * @ORM\ManyToMany(targetEntity=Service::class, inversedBy="barbers",cascade={"remove"})
     *
=======
     * @ORM\ManyToMany(targetEntity=service::class, inversedBy="barbers")
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28
     */
    private $services;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
        $this->services = new ArrayCollection();
    }


    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * @return Collection|appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setBarber($this);
        }

        return $this;
    }

    public function removeAppointment(appointment $appointment): self
    {
        if ($this->appointment->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getBarber() === $this) {
                $appointment->setBarber(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(service $service): self
    {
        $this->services->removeElement($service);

        return $this;
    }
<<<<<<< HEAD

    /**
     * @return Collection|Availability[]
     */
    public function getAvailabilities(): Collection
    {
        return $this->availabilities;
    }

    public function addAvailability(Availability $availability): self
    {
        if (!$this->availabilities->contains($availability)) {
            $this->availabilities[] = $availability;
        }

        return $this;
    }

    public function removeAvailability(Availability $availability): self
    {
        $this->availabilities->removeElement($availability);

        return $this;
    }
=======
>>>>>>> be84bfe9b2260b8591678331d95f2d169309db28
}
