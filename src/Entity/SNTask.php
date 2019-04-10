<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SNTaskRepository")
 */
class SNTask
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Groups({"sntask"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Expose()
     * @Serializer\Groups({"sntask"})
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="sNTasks")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\Groups({"sntask"})
     */
    private $specialisation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"sntask"})
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SNCompetence", inversedBy="tasks")
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

    public function getSpecialisation(): ?Specialisation
    {
        return $this->specialisation;
    }

    public function setSpecialisation(?Specialisation $specialisation): self
    {
        $this->specialisation = $specialisation;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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
