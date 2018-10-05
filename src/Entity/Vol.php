<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Vollist", inversedBy="vols")
     */
    private $volnum;

    public function getVolnum(): ?Vollist
    {
        return $this->volnum;
    }

    public function setVolnum(?Vollist $volnum): self
    {
        $this->volnum = $volnum;

        return $this;
    }


}
