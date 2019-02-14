<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="scores")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="scores")
     */
    private $parcours;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $temps;

    /**
     * @ORM\Column(type="integer", length=255,  nullable=true)
     */
    private $nbPoint;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $points;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PointTrouve", mappedBy="score")
     */
    private $pointTrouves;

    public function __construct()
    {
        $this->pointTrouves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self
    {
        $this->parcours = $parcours;

        return $this;
    }

    public function getTemps(): ?string
    {
        return $this->temps;
    }

    public function setTemps(string $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getnbPoint(): ?int
    {
        return $this->nbPoint;
    }

    public function setnbPoint(?int $nbPoint): self
    {
        $this->nbPoint = $nbPoint;
        return $this;

    }

    /**
     * @return Collection|PointTrouve[]
     */
    public function getPointTrouves(): Collection
    {
        return $this->pointTrouves;
    }

    public function addPointTrouve(PointTrouve $pointTrouve): self
    {
        if (!$this->pointTrouves->contains($pointTrouve)) {
            $this->pointTrouves[] = $pointTrouve;
            $pointTrouve->setScore($this);
        }

        return $this;
    }

    public function removePointTrouve(PointTrouve $pointTrouve): self
    {
        if ($this->pointTrouves->contains($pointTrouve)) {
            $this->pointTrouves->removeElement($pointTrouve);
            // set the owning side to null (unless already changed)
            if ($pointTrouves->getScore() === $this) {
                $pointTrouves->setScore(null);
            }
        }

        return $this;
    }

    public function addPointTroufe(PointTrouve $pointTroufe): self
    {
        if (!$this->pointTrouves->contains($pointTroufe)) {
            $this->pointTrouves[] = $pointTroufe;
            $pointTroufe->setScore($this);
        }

        return $this;
    }

    public function removePointTroufe(PointTrouve $pointTroufe): self
    {
        if ($this->pointTrouves->contains($pointTroufe)) {
            $this->pointTrouves->removeElement($pointTroufe);
            // set the owning side to null (unless already changed)
            if ($pointTroufe->getScore() === $this) {
                $pointTroufe->setScore(null);
            }
        }

        return $this;
    }

}
