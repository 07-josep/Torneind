<?php

namespace App\Entity;

use App\Repository\ModalidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModalidadRepository::class)
 */
class Modalidad
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
    private $modalidad;

    /**
     * @ORM\OneToMany(targetEntity=Torneo::class, mappedBy="modalidad")
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

    public function getModalidad(): ?string
    {
        return $this->modalidad;
    }

    public function setModalidad(string $modalidad): self
    {
        $this->modalidad = $modalidad;

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
            $torneo->setModalidad($this);
        }

        return $this;
    }

    public function removeTorneo(Torneo $torneo): self
    {
        if ($this->torneos->removeElement($torneo)) {
            // set the owning side to null (unless already changed)
            if ($torneo->getModalidad() === $this) {
                $torneo->setModalidad(null);
            }
        }

        return $this;
    }
}
