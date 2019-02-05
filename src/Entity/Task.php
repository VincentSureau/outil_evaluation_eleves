<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tp", mappedBy="task")
     */
    private $tps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="task")
     */
    private $specialisation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competence", mappedBy="tasks")
     */
    private $competences;

    public function __construct()
    {
        $this->tps = new ArrayCollection();
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Tp[]
     */
    public function getTps(): Collection
    {
        return $this->tps;
    }

    public function addTp(Tp $tp): self
    {
        if (!$this->tps->contains($tp)) {
            $this->tps[] = $tp;
            $tp->addTask($this);
        }

        return $this;
    }

    public function removeTp(Tp $tp): self
    {
        if ($this->tps->contains($tp)) {
            $this->tps->removeElement($tp);
            $tp->removeTask($this);
        }

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

    public function __toString(): string
    {
        return $this->reference . ' - ' . $this->name;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addTask($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
            $competence->removeTask($this);
        }

        return $this;
    }
}
