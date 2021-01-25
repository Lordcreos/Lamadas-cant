<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CtCampanas", inversedBy="users")
     * @ORM\JoinColumn(name="ctcampanas_id", referencedColumnName="id", nullable=true)
     */
    private $ctcampanas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CtRegistros", mappedBy="userntg")
     */
    private $ctregistrosntg;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CtRegistros", mappedBy="useraxis")
     */
    private $ctregistrosaxis;


    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(min=6, max=15, groups={"registration"})
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(name="USU_NOMBRES", type="string", length=200, nullable=true)
     */
    private $usuNombres;

    /**
     * @var string
     * @ORM\Column(name="USU_APELLIDOS", type="string", length=200, nullable=true)
     */
    private $usuApellidos;

    public function __construct()
    {
        parent::__construct();
        $this->ctregistrosntg = new ArrayCollection();
        $this->ctregistrosaxis = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->usuNombres. " " .$this->usuApellidos;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuNombres(): ?string
    {
        return $this->usuNombres;
    }

    public function setUsuNombres(?string $usuNombres): self
    {
        $this->usuNombres = $usuNombres;

        return $this;
    }

    public function getUsuApellidos(): ?string
    {
        return $this->usuApellidos;
    }

    public function setUsuApellidos(?string $usuApellidos): self
    {
        $this->usuApellidos = $usuApellidos;

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

    /**
     * @return Collection|CtRegistros[]
     */
    public function getCtregistrosntg(): Collection
    {
        return $this->ctregistrosntg;
    }

    public function addCtregistrosntg(CtRegistros $ctregistrosntg): self
    {
        if (!$this->ctregistrosntg->contains($ctregistrosntg)) {
            $this->ctregistrosntg[] = $ctregistrosntg;
            $ctregistrosntg->setUserntg($this);
        }

        return $this;
    }

    public function removeCtregistrosntg(CtRegistros $ctregistrosntg): self
    {
        if ($this->ctregistrosntg->contains($ctregistrosntg)) {
            $this->ctregistrosntg->removeElement($ctregistrosntg);
            // set the owning side to null (unless already changed)
            if ($ctregistrosntg->getUserntg() === $this) {
                $ctregistrosntg->setUserntg(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CtRegistros[]
     */
    public function getCtregistrosaxis(): Collection
    {
        return $this->ctregistrosaxis;
    }

    public function addCtregistrosaxi(CtRegistros $ctregistrosaxi): self
    {
        if (!$this->ctregistrosaxis->contains($ctregistrosaxi)) {
            $this->ctregistrosaxis[] = $ctregistrosaxi;
            $ctregistrosaxi->setUseraxis($this);
        }

        return $this;
    }

    public function removeCtregistrosaxi(CtRegistros $ctregistrosaxi): self
    {
        if ($this->ctregistrosaxis->contains($ctregistrosaxi)) {
            $this->ctregistrosaxis->removeElement($ctregistrosaxi);
            // set the owning side to null (unless already changed)
            if ($ctregistrosaxi->getUseraxis() === $this) {
                $ctregistrosaxi->setUseraxis(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }


}
