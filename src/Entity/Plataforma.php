<?php

namespace App\Entity;

use App\Repository\PlataformaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlataformaRepository::class)
 */
class Plataforma
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $plataforma;

    /**
     * @ORM\OneToMany(targetEntity=Torneo::class, mappedBy="plataforma")
     */
    private $torneos;

    public function __construct()
    {
        $this->torneos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlataforma(): ?string
    {
        return $this->plataforma;
    }

    public function setPlataforma(string $plataforma): self
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    /**
     * @return Collection|Torneo[]
     */
    public function getTorneos(): Collection
    {
        return $this->torneos;
    }

    public function addTorneo(Torneo $torneo): self
    {
        if (!$this->torneos->contains($torneo)) {
            $this->torneos[] = $torneo;
            $torneo->setPlataforma($this);
        }

        return $this;
    }

    public function removeTorneo(Torneo $torneo): self
    {
        if ($this->torneos->removeElement($torneo)) {
            // set the owning side to null (unless already changed)
            if ($torneo->getPlataforma() === $this) {
                $torneo->setPlataforma(null);
            }
        }

        return $this;
    }
}
