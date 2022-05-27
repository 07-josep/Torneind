<?php

namespace App\Entity;
use App\Repository\TorneoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=TorneoRepository::class)
 * @Vich\Uploadable
 */
class Torneo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotNull(message="El nombre del torneo es obligatorio.")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="La descripción del torneo es obligatoria.")
     */
    private $descripcion;



    /**
     * @ORM\Column(type="string", length=255)
     */

    private $imagen;


    /**
     * @Vich\UploadableField(mapping="movies_poster", fileNameProperty="imagen")
     * @var File
     */
    private $imagenFile;

    /**
     * @return File
     */
    public function getImagenFile(): ?File
    {
        return $this->imagenFile;
    }

    // ...

    public function setImagenFile(File $image = null)
    {
        $this->imagenFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull(message="Fecha obligatoría ( Hora se establece por defecto si no elige una.")
     * @Assert\GreaterThan("today UTC")

     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="torneos")
     * @ORM\JoinColumn(nullable=false)
     */
    private Usuario $usuario;

    /**
     * @ORM\ManyToOne(targetEntity=Modalidad::class, inversedBy="torneos")
     * @ORM\JoinColumn(nullable=false)
     *@Assert\NotNull(message="La modalidad es obligatoria.")

     */
    private $modalidad;

    /**
     * @ORM\ManyToOne(targetEntity=Plataforma::class, inversedBy="torneos")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="La plataforma de juego es obligatoria.")
     */
    private $plataforma;

    /**
     * @ORM\OneToMany(targetEntity=Inscripcion::class, mappedBy="torneo")
     */

    private $inscripcions;

    /**
     * @ORM\OneToMany(targetEntity=Opinion::class, mappedBy="torneo")
     */
    private $opinions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $retransmision;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotNull(message="El código es obligatorio")
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "El código ha de tener {{ limit }} carácteres",
     *      maxMessage = "El código no puede superar los {{ limit }} carácteres"
     * )
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(message="Tiene que asignar un ganador para el torneo.")
     */
    private $ganador;

    public function __construct()
    {
        $this->inscripcions = new ArrayCollection();
        $this->opinions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    public function getModalidad(): ?Modalidad
    {
        return $this->modalidad;
    }

    public function setModalidad(?Modalidad $modalidad): self
    {
        $this->modalidad = $modalidad;

        return $this;
    }

    public function getPlataforma(): ?Plataforma
    {
        return $this->plataforma;
    }

    public function setPlataforma(?Plataforma $plataforma): self
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    /**
     * @return Collection|Inscripcion[]
     */
    public function getInscripcions(): Collection
    {
        return $this->inscripcions;
    }

    public function addInscripcion(Inscripcion $inscripcion): self
    {
        if (!$this->inscripcions->contains($inscripcion)) {
            $this->inscripcions[] = $inscripcion;
            $inscripcion->setTorneo($this);
        }

        return $this;
    }

    public function removeInscripcion(Inscripcion $inscripcion): self
    {
        if ($this->inscripcions->removeElement($inscripcion)) {
            // set the owning side to null (unless already changed)
            if ($inscripcion->getTorneo() === $this) {
                $inscripcion->setTorneo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Opinion[]
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions[] = $opinion;
            $opinion->setTorneo($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->removeElement($opinion)) {
            if ($opinion->getTorneo() === $this) {
                $opinion->setTorneo(null);
            }
        }

        return $this;
    }

    public function getRetransmision(): ?string
    {
        return $this->retransmision;
    }

    public function setRetransmision(?string $retransmision): self
    {
        $this->retransmision = $retransmision;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }


    public function getGanador(): ?string
    {
        return $this->ganador;
    }


    public function setGanador(?string $ganador): self
    {
        $this->ganador = $ganador;

        return $this;
    }
}
