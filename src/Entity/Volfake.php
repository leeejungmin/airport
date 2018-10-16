<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Volfake
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
