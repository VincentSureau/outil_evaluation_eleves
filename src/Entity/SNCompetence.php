<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SNCompetenceRepository")
 */
class SNCompetence
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
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SNTask", mappedBy="competence")
     */
    private $sNTasks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="sNCompetences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialisation;

    public function __construct()
    {
        $this->sNTasks = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|SNTask[]
     */
    public function getSNTasks(): Collection
    {
        return $this->sNTasks;
    }

    public function addSNTask(SNTask $sNTask): self
    {
        if (!$this->sNTasks->contains($sNTask)) {
            $this->sNTasks[] = $sNTask;
            $sNTask->setCompetence($this);
        }

        return $this;
    }

    public function removeSNTask(SNTask $sNTask): self
    {
        if ($this->sNTasks->contains($sNTask)) {
            $this->sNTasks->removeElement($sNTask);
            // set the owning side to null (unless already changed)
            if ($sNTask->getCompetence() === $this) {
                $sNTask->setCompetence(null);
            }
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
}
