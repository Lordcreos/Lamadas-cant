<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CtCampanasRepository")
 */
class CtCampanas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="ctcampanas")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CtRegistros", mappedBy="ctcampanas")
     */
    private $ctregistros;


    /**
     * @ORM\Column(type="string", length=80)
     */
    private $camNombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $camEstado;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->ctregistros = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->camNombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCamNombre(): ?string
    {
        return $this->camNombre;
    }

    public function setCamNombre(string $camNombre): self
    {
        $this->camNombre = $camNombre;

        return $this;
    }

    public function getCamEstado(): ?bool
    {
        return $this->camEstado;
    }

    public function setCamEstado(bool $camEstado): self
    {
        $this->camEstado = $camEstado;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setCtcampanas($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCtcampanas() === $this) {
                $user->setCtcampanas(null);
            }
        }

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
            $ctregistro->setCtcampanas($this);
        }

        return $this;
    }

    public function removeCtregistro(CtRegistros $ctregistro): self
    {
        if ($this->ctregistros->contains($ctregistro)) {
            $this->ctregistros->removeElement($ctregistro);
            // set the owning side to null (unless already changed)
            if ($ctregistro->getCtcampanas() === $this) {
                $ctregistro->setCtcampanas(null);
            }
        }

        return $this;
    }
}
