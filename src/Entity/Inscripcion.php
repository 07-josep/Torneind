<?php

namespace App\Entity;

use App\Repository\InscripcionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TorneoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=InscripcionRepository::class)
 * @UniqueEntity(
 *     fields={"torneo"},
 *     errorPath="port",
 *     message="This port is already in use on that host."
 * ) */
class Inscripcion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El nombre del equipo es obligatorio")
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "El nombre de equipo tiene que ser súperior a 4 letras.",
     *      maxMessage = "El nombre de equipo es demasiado largo.")
     */
    private $tagname;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="inscripcions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Torneo::class, inversedBy="inscripcions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $torneo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTagname(): ?string
    {
        return $this->tagname;
    }

    public function setTagname(string $tagname): self
    {
        $this->tagname = $tagname;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getTorneo(): ?Torneo
    {
        return $this->torneo;
    }

    public function setTorneo(?Torneo $torneo): self
    {
        $this->torneo = $torneo;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getTagname();


    }
}
