<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CtParGlobalesRepository")
 */
class CtParGlobales
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $parCodigo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $parValor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $parEstado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParCodigo(): ?string
    {
        return $this->parCodigo;
    }

    public function setParCodigo(string $parCodigo): self
    {
        $this->parCodigo = $parCodigo;

        return $this;
    }

    public function getParValor(): ?string
    {
        return $this->parValor;
    }

    public function setParValor(string $parValor): self
    {
        $this->parValor = $parValor;

        return $this;
    }

    public function getParEstado(): ?bool
    {
        return $this->parEstado;
    }

    public function setParEstado(bool $parEstado): self
    {
        $this->parEstado = $parEstado;

        return $this;
    }

}
