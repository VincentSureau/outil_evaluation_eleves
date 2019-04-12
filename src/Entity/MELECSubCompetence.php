<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MELECSubCompetenceRepository")
 */
class MELECSubCompetence
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
     * @ORM\ManyToOne(targetEntity="App\Entity\MELECCompetence", inversedBy="mELECSubCompetences")
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

    public function getCompetence(): ?MELECCompetence
    {
        return $this->competence;
    }

    public function setCompetence(?MELECCompetence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

}
