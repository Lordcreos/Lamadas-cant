<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CtTipLlamadasRepository")
 */
class CtTipLlamadas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CtRegistros", mappedBy="cttipllamadas")
     */
    private $ctregistros;


    /**
     * @ORM\Column(type="string", length=80)
     */
    private $tipLlaNombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tipLlaEstado;

    public function __construct()
    {
        $this->ctregistros = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->tipLlaNombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipLlaNombre(): ?string
    {
        return $this->tipLlaNombre;
    }

    public function setTipLlaNombre(string $tipLlaNombre): self
    {
        $this->tipLlaNombre = $tipLlaNombre;

        return $this;
    }

    public function getTipLlaEstado(): ?bool
    {
        return $this->tipLlaEstado;
    }

    public function setTipLlaEstado(bool $tipLlaEstado): self
    {
        $this->tipLlaEstado = $tipLlaEstado;

        return $this;
    }

    /**
     * @return Collection|CtRegistros[]
     */
    public function getCtregistros(): Collection
    {
        return $this->ctregistros;
    }

    public function addCtregistro(CtRegistros $ctregistro): self
    {
        if (!$this->ctregistros->contains($ctregistro)) {
            $this->ctregistros[] = $ctregistro;
            $ctregistro->setCttipllamadas($this);
        }

        return $this;
    }

    public function removeCtregistro(CtRegistros $ctregistro): self
    {
        if ($this->ctregistros->contains($ctregistro)) {
            $this->ctregistros->removeElement($ctregistro);
            // set the owning side to null (unless already changed)
            if ($ctregistro->getCttipllamadas() === $this) {
                $ctregistro->setCttipllamadas(null);
            }
        }

        return $this;
    }
}
