<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;






    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Passenger", mappedBy="vol")
     */
    private $passengers;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $volnum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pilote", inversedBy="vol")
     */
    private $pilot;

    public function __construct()
    {
        $this->passengers = new ArrayCollection();
    }





  

    /**
     * @return Collection|Passenger[]
     */
    public function getPassengers(): Collection
    {
        return $this->passengers;
    }

    public function addPassenger(Passenger $passenger): self
    {
        if (!$this->passengers->contains($passenger)) {
            $this->passengers[] = $passenger;
            $passenger->addVol($this);
        }

        return $this;
    }

    public function removePassenger(Passenger $passenger): self
    {
        if ($this->passengers->contains($passenger)) {
            $this->passengers->removeElement($passenger);
            $passenger->removeVol($this);
        }

        return $this;
    }

    public function getVolnum(): ?string
    {
        return $this->volnum;
    }

    public function setVolnum(string $volnum): self
    {
        $this->volnum = $volnum;

        return $this;
    }

    public function getPilot(): ?Pilote
    {
        return $this->pilot;
    }

    public function setPilot(?Pilote $pilot): self
    {
        $this->pilot = $pilot;

        return $this;
    }


}
