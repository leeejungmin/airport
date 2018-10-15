<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PiloteRepository")
 */
class Pilote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;





  

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Volfake", mappedBy="pilot")
     */
    private $vol;

    public function __construct()
    {
        $this->vol = new ArrayCollection();
    }







    public function getId(): ?int
    {
        return $this->id;
    }



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVol(): Collection
    {
        return $this->vol;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->vol->contains($vol)) {
            $this->vol[] = $vol;
            $vol->setPilot($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->vol->contains($vol)) {
            $this->vol->removeElement($vol);
            // set the owning side to null (unless already changed)
            if ($vol->getPilot() === $this) {
                $vol->setPilot(null);
            }
        }

        return $this;
    }





}
