<?php
namespace App\Entity;
use Exception;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Serializable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\TorneoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @Vich\Uploadable
 * @method string getUserIdentifier()
 */


class Usuario implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string", length=30)
     * @Assert\Type("string")
     * @Assert\NotNull(message="El nombre de usuario es obligatorio.")
     * @Assert\Length(
     *      min = 4,
     *      max = 30,
     *      minMessage = "Tú nombre tiene que ser superior a 4 carácteres.",
     *      maxMessage = "Tú nombre supera los carácteres permitidos.")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="El correo es obligatorio.")
     * @Assert\Email(message="El email que has introducido no es correcto.")
     */


    private $correo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="La contraseña es obligatoria.")
     */
    private $contrasenya;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    private $foto;

    /**
     * @Vich\UploadableField(mapping="movies_poster", fileNameProperty="foto")
     * @var File
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "La foto tiene que ser PNG, JPEG,JPG y menor de 1024K"
     * )
     */
    private $imagenFile;

    /**
     * @return File
     */
    public function getImagenFile(): ?File
    {
        return $this->imagenFile;
    }

    public function setImagenFile( ?File $image = null)
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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto( ?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Torneo::class, mappedBy="usuario")
     */
    private $torneos;

    /**
     * @ORM\OneToMany(targetEntity=Inscripcion::class, mappedBy="usuario")
     */
    private $inscripcions;

    /**
     * @ORM\OneToMany(targetEntity=Mensaje::class, mappedBy="enviado")
     */
    private $mensajes;

    /**
     * @ORM\OneToMany(targetEntity=Opinion::class, mappedBy="usuario")
     */
    private $opinions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuenta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $directo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuenta_sony;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuenta_microsoft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuenta_epic;

    public function __construct()
    {
        $this->torneos = new ArrayCollection();
        $this->inscripcions = new ArrayCollection();
        $this->mensajes = new ArrayCollection();
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

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getContrasenya(): ?string
    {
        return $this->contrasenya;
    }

    public function setContrasenya(string $contrasenya): self
    {
        $this->contrasenya = $contrasenya;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
            $torneo->setUsuario($this);
        }

        return $this;
    }

    public function removeTorneo(Torneo $torneo): self
    {
        if ($this->torneos->removeElement($torneo)) {
            // set the owning side to null (unless already changed)
            if ($torneo->getUsuario() === $this) {
                $torneo->setUsuario(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
        return [$this->role];

    }

    public function getPassword() :?string
    {
        return $this->getContrasenya();
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
        return $this->nombre;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
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
            $inscripcion->setUsuario($this);
        }

        return $this;
    }

    public function removeInscripcion(Inscripcion $inscripcion): self
    {
        if ($this->inscripcions->removeElement($inscripcion)) {
            // set the owning side to null (unless already changed)
            if ($inscripcion->getUsuario() === $this) {
                $inscripcion->setUsuario(null);
            }
        }

        return $this;
    }


    public function serialize()
    {
        // TODO: Implement serialize() method.
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->correo,
            $this->contrasenya,
            $this->foto,
            $this->torneos,
            $this->inscripcions
        ));
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
        list(
            $this->id,
            $this->nombre,
            $this->correo,
            $this->contrasenya,
            $this->foto,
            $this->torneos,
            $this->inscripcions
            ) = unserialize($serialized);
    }

    /**
     * @return Collection|Mensaje[]
     */
    public function getMensajes(): Collection
    {
        return $this->mensajes;
    }

    public function addMensaje(Mensaje $mensaje): self
    {
        if (!$this->mensajes->contains($mensaje)) {
            $this->mensajes[] = $mensaje;
            $mensaje->setEnviado($this);
        }

        return $this;
    }

    public function removeMensaje(Mensaje $mensaje): self
    {
        if ($this->mensajes->removeElement($mensaje)) {
            // set the owning side to null (unless already changed)
            if ($mensaje->getEnviado() === $this) {
                $mensaje->setEnviado(null);
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
            $opinion->setUsuario($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getUsuario() === $this) {
                $opinion->setUsuario(null);
            }
        }

        return $this;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    public function setCuenta(?string $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getDirecto(): ?string
    {
        return $this->directo;
    }

    public function setDirecto(?string $directo): self
    {
        $this->directo = $directo;

        return $this;
    }

    public function getCuentaSony(): ?string
    {
        return $this->cuenta_sony;
    }

    public function setCuentaSony(?string $cuenta_sony): self
    {
        $this->cuenta_sony = $cuenta_sony;

        return $this;
    }

    public function getCuentaMicrosoft(): ?string
    {
        return $this->cuenta_microsoft;
    }

    public function setCuentaMicrosoft(?string $cuenta_microsoft): self
    {
        $this->cuenta_microsoft = $cuenta_microsoft;

        return $this;
    }

    public function getCuentaEpic(): ?string
    {
        return $this->cuenta_epic;
    }

    public function setCuentaEpic(?string $cuenta_epic): self
    {
        $this->cuenta_epic = $cuenta_epic;

        return $this;
    }
}
