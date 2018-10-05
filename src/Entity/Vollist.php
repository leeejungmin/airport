<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VollistRepository")
 */
class Vollist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $passenger;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $pilot;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $volnum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="volnum")
     */
    private $vols;

    public function __construct()
    {
        $this->vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassenger(): ?string
    {
        return $this->passenger;
    }

    public function setPassenger(?string $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getPilot(): ?string
    {
        return $this->pilot;
    }

    public function setPilot(?string $pilot): self
    {
        $this->pilot = $pilot;

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

    /**
     * @return Collection|Vol[]
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
            $vol->setVolnum($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->vols->contains($vol)) {
            $this->vols->removeElement($vol);
            // set the owning side to null (unless already changed)
            if ($vol->getVolnum() === $this) {
                $vol->setVolnum(null);
            }
        }

        return $this;
    }
}
