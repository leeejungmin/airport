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
     * @ORM\OneToOne(targetEntity="App\Entity\user", inversedBy="passenger", cascade={"persist", "remove"})
     */
    private $user;



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

    public function getUser(): ?Uuser
    {
        return $this->user;
    }

    public function setUser(?Uuser $user): self
    {
        $this->user = $user;

        return $this;
    }




}
