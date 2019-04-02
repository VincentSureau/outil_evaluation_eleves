<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SNSubCompetenceRepository")
 */
class SNSubCompetence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SNCompetence", inversedBy="sNSubCompetences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getCompetence(): ?SNCompetence
    {
        return $this->competence;
    }

    public function setCompetence(?SNCompetence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
