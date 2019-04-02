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
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="sNCompetences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialisation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SNSubCompetence", mappedBy="competence")
     */
    private $sNSubCompetences;

    public function __construct()
    {
        $this->sNSubCompetences = new ArrayCollection();
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

    public function getSpecialisation(): ?Specialisation
    {
        return $this->specialisation;
    }

    public function setSpecialisation(?Specialisation $specialisation): self
    {
        $this->specialisation = $specialisation;

        return $this;
    }

    /**
     * @return Collection|SNSubCompetence[]
     */
    public function getSNSubCompetences(): Collection
    {
        return $this->sNSubCompetences;
    }

    public function addSNSubCompetence(SNSubCompetence $sNSubCompetence): self
    {
        if (!$this->sNSubCompetences->contains($sNSubCompetence)) {
            $this->sNSubCompetences[] = $sNSubCompetence;
            $sNSubCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeSNSubCompetence(SNSubCompetence $sNSubCompetence): self
    {
        if ($this->sNSubCompetences->contains($sNSubCompetence)) {
            $this->sNSubCompetences->removeElement($sNSubCompetence);
            // set the owning side to null (unless already changed)
            if ($sNSubCompetence->getCompetence() === $this) {
                $sNSubCompetence->setCompetence(null);
            }
        }

        return $this;
    }
}
