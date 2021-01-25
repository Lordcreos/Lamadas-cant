<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CtRegistrosRepository")
 */
class CtRegistros
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CtCampanas", inversedBy="ctregistros")
     */
    private $ctcampanas;

    /**
     * @ORM\ManyToOne(targetEntity="CtTipLlamadas", inversedBy="ctregistros")
     */
    private $cttipllamadas;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ctregistrosntg")
     */
    private $userntg;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ctregistrosaxis")
     * @ORM\JoinColumn(nullable=true)
     */
    private $useraxis;


    /**
     * @ORM\Column(type="string", length=15)
     */
    private $regDocumento;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $regTelefono;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $regNombre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $regProducto;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $regTipGestion;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $obsOtrCampana;

    /**
     * @ORM\Column(type="datetime")
     */
    private $regFecRegistro;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $regFecGestion;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $regEstado;

    public function __toString()
    {
        return $this->regNombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegDocumento(): ?string
    {
        return $this->regDocumento;
    }

    public function setRegDocumento(string $regDocumento): self
    {
        $this->regDocumento = $regDocumento;

        return $this;
    }

    public function getRegTelefono(): ?string
    {
        return $this->regTelefono;
    }

    public function setRegTelefono(string $regTelefono): self
    {
        $this->regTelefono = $regTelefono;

        return $this;
    }

    public function getRegNombre(): ?string
    {
        return $this->regNombre;
    }

    public function setRegNombre(string $regNombre): self
    {
        $this->regNombre = $regNombre;

        return $this;
    }

    public function getRegProducto(): ?string
    {
        return $this->regProducto;
    }

    public function setRegProducto(string $regProducto): self
    {
        $this->regProducto = $regProducto;

        return $this;
    }

    public function getRegTipGestion(): ?string
    {
        return $this->regTipGestion;
    }

    public function setRegTipGestion(string $regTipGestion): self
    {
        $this->regTipGestion = $regTipGestion;

        return $this;
    }

    public function getRegFecRegistro(): ?\DateTimeInterface
    {
        return $this->regFecRegistro;
    }

    public function setRegFecRegistro(\DateTimeInterface $regFecRegistro): self
    {
        $this->regFecRegistro = $regFecRegistro;

        return $this;
    }

    public function getRegFecGestion(): ?\DateTimeInterface
    {
        return $this->regFecGestion;
    }

    public function setRegFecGestion(\DateTimeInterface $regFecGestion): self
    {
        $this->regFecGestion = $regFecGestion;

        return $this;
    }


    public function getCtcampanas(): ?CtCampanas
    {
        return $this->ctcampanas;
    }

    public function setCtcampanas(?CtCampanas $ctcampanas): self
    {
        $this->ctcampanas = $ctcampanas;

        return $this;
    }

    public function getCttipllamadas(): ?CtTipLlamadas
    {
        return $this->cttipllamadas;
    }

    public function setCttipllamadas(?CtTipLlamadas $cttipllamadas): self
    {
        $this->cttipllamadas = $cttipllamadas;

        return $this;
    }

    public function getUserntg(): ?User
    {
        return $this->userntg;
    }

    public function setUserntg(?User $userntg): self
    {
        $this->userntg = $userntg;

        return $this;
    }

    public function getRegEstado(): ?string
    {
        return $this->regEstado;
    }

    public function setRegEstado(string $regEstado): self
    {
        $this->regEstado = $regEstado;

        return $this;
    }

    public function getUseraxis(): ?User
    {
        return $this->useraxis;
    }

    public function setUseraxis(?User $useraxis): self
    {
        $this->useraxis = $useraxis;

        return $this;
    }

    public function getObsOtrCampana(): ?string
    {
        return $this->obsOtrCampana;
    }

    public function setObsOtrCampana(?string $obsOtrCampana): self
    {
        $this->obsOtrCampana = $obsOtrCampana;

        return $this;
    }


}
