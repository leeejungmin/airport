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
     * @ORM\Column(type="string", length=100)
     */
    private $volnum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pilote")
     */
    private $pilote;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="passager" , cascade={"persist", "remove"})
     */
    private $passager;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $arrive;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $depart;




    public function __construct()
    {
        $this->passager = new ArrayCollection();
    }




    public function getid(): ?int
    {
        return $this->id;
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

    public function getPilote(): ?User
    {
        return $this->pilote;
    }

    public function setPilote(?User $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPassager(): Collection
    {
        return $this->passager;
    }

    public function addPassager(User $passager): self
    {
        if (!$this->passager->contains($passager)) {
            $this->passager[] = $passager;
            $passager->addPassager($this);
        }

        return $this;
    }
    
    public function removePassager(User $passager): self
    {
        if ($this->passager->contains($passager)) {
            $this->passager->removeElement($passager);
            $passager->removePassager($this);
        }

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getArrive(): ?\DateTimeInterface
    {
        return $this->arrive;
    }

    public function setArrive(?\DateTimeInterface $arrive): self
    {
        $this->arrive = $arrive;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(?\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Generates the magic method
     *
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
