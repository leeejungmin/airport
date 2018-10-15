<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassengerRepository")
 */
class Passenger
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Volfake", inversedBy="passengers")
     */
    private $vol;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Uuser", mappedBy="passenger", cascade={"persist", "remove"})
     */
    private $userr;

    public function __construct()
    {
        $this->vol = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVol(): Collection
    {
        return $this->vol;
    }

    public function addVol(Volfake $vol): self
    {
        if (!$this->vol->contains($vol)) {
            $this->vol[] = $vol;
        }

        return $this;
    }

    public function removeVol(Volfake $vol): self
    {
        if ($this->vol->contains($vol)) {
            $this->vol->removeElement($vol);
        }

        return $this;
    }


    public function getUserr(): ?Uuser
    {
        return $this->userr;
    }

    public function setUserr(?Uuser $userr): self
    {
        $this->userr = $userr;

        // set (or unset) the owning side of the relation if necessary
        $newPassenger = $userr === null ? null : $this;
        if ($newPassenger !== $userr->getPassenger()) {
            $userr->setPassenger($newPassenger);
        }

        return $this;
    }


}
