<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndiceRepository")
 */
class Indice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Points", inversedBy="indices")
     */
    private $point;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $obligatoire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Cout;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPoint(): ?Points
    {
        return $this->point;
    }

    public function setPoint(?Points $point): self
    {
        $this->point = $point;

        return $this;
    }

    public function getObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(?bool $obligatoire): self
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function getCout(): ?int
    {
        return $this->Cout;
    }

    public function setCout(?int $Cout): self
    {
        $this->Cout = $Cout;

        return $this;
    }
}
