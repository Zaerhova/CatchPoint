<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointTrouveRepository")
 */
class PointTrouve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Points", inversedBy="pointTrouves")
     */
    private $point;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Score", inversedBy="pointTrouves")
     */
    private $score;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $trouve;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getScore(): ?Score
    {
        return $this->score;
    }

    public function setScore(?Score $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getTrouve(): ?bool
    {
        return $this->trouve;
    }

    public function setTrouve(?bool $trouve): self
    {
        $this->trouve = $trouve;

        return $this;
    }
}
