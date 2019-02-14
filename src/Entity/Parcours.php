<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Double;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParcoursRepository")
 */
class Parcours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomParcours;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $longueurParcours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeParcours;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal" ,precision=10, scale=5)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal" ,precision=10, scale=5)
     */
    private $lng;

    /**
     * @ORM\Column(type="integer")
     */
    private $zoom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Points", mappedBy="parcours")
     */
    private $points;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="parcours")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=10000, nullable=true)
     */
    private $json;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="parcoursRejoint")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Score", mappedBy="parcours")
     * @ORM\OrderBy({"points" = "DESC"})
     */
    private $scores;




    public function __construct()
    {
        $this->points = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->scores = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomParcours(): ?string
    {
        return $this->nomParcours;
    }

    public function setNomParcours(string $nomParcours): self
    {
        $this->nomParcours = $nomParcours;

        return $this;
    }

    public function getLongueurParcours()
    {
        return $this->longueurParcours;
    }

    public function setLongueurParcours($longueurParcours): self
    {
        $this->longueurParcours = $longueurParcours;

        return $this;
    }

    public function getTypeParcours(): ?string
    {
        return $this->typeParcours;
    }

    public function setTypeParcours(string $typeParcours): self
    {
        $this->typeParcours = $typeParcours;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(float $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getZoom(): ?int
    {
        return $this->zoom;
    }

    public function setZoom(int $zoom): self
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * @return Collection|Points[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Points $point)
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->setParcours($this);
        }

        return $this;
    }

    public function removePoint(Points $point): self
    {
        if ($this->points->contains($point)) {
            $this->points->removeElement($point);
            // set the owning side to null (unless already changed)
            if ($point->getParcours() === $this) {
                $point->setParcours(null);
            }
        }

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
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    public function getJson(): ?string
    {
        return $this->json;
    }

    public function setJson(?string $json): self
    {
        $this->json = $json;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return Collection|Score[]
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setParcours($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->contains($score)) {
            $this->scores->removeElement($score);
            // set the owning side to null (unless already changed)
            if ($score->getParcours() === $this) {
                $score->setParcours(null);
            }
        }

        return $this;
    }





}
