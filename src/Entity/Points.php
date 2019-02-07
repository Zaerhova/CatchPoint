<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointsRepository")
 */
class Points
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", inversedBy="points")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parcours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=5)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=5)
     */
    private $lng;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Indice", mappedBy="point")
     */
    private $indices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PointTrouve", mappedBy="point")
     */
    private $pointTrouves;

    public function __construct()
    {
        $this->indices = new ArrayCollection();
        $this->pointTrouves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return Collection|Indice[]
     */
    public function getIndices(): Collection
    {
        return $this->indices;
    }

    public function addIndex(Indice $index): self
    {
        if (!$this->indices->contains($index)) {
            $this->indices[] = $index;
            $index->setPoint($this);
        }

        return $this;
    }

    public function removeIndex(Indice $index): self
    {
        if ($this->indices->contains($index)) {
            $this->indices->removeElement($index);
            // set the owning side to null (unless already changed)
            if ($index->getPoint() === $this) {
                $index->setPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PointTrouve[]
     */
    public function getPointTrouves(): Collection
    {
        return $this->pointTrouves;
    }

    public function addPointTroufe(PointTrouve $pointTroufe): self
    {
        if (!$this->pointTrouves->contains($pointTroufe)) {
            $this->pointTrouves[] = $pointTroufe;
            $pointTroufe->setPoint($this);
        }

        return $this;
    }

    public function removePointTroufe(PointTrouve $pointTroufe): self
    {
        if ($this->pointTrouves->contains($pointTroufe)) {
            $this->pointTrouves->removeElement($pointTroufe);
            // set the owning side to null (unless already changed)
            if ($pointTroufe->getPoint() === $this) {
                $pointTroufe->setPoint(null);
            }
        }

        return $this;
    }
}
