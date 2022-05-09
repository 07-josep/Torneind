<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MensajeRepository::class)
 */
class Mensaje
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El mensaje es obligatorio.")
     * @Assert\Length(
     *      min = 4,
     *      max = 255,
     *      minMessage = "El mensaje es demasiado pequeño. ",
     *      maxMessage = "No le cuenets tu vida tampoco. Muy largo.")
     */
    private $mensaje;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="mensajes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enviado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(): self
    {
        $this->fecha = new \DateTimeImmutable();
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="mensajes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recibidos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getEnviado(): ?Usuario
    {
        return $this->enviado;
    }

    public function setEnviado(?Usuario $enviado): self
    {
        $this->enviado = $enviado;

        return $this;
    }

    public function getRecibidos(): ?Usuario
    {
        return $this->recibidos;
    }

    public function setRecibidos(?Usuario $recibidos): self
    {
        $this->recibidos = $recibidos;

        return $this;
    }
}
