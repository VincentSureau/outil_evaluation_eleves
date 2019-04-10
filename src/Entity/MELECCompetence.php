<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MELECCompetenceRepository")
 */
class MELECCompetence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Groups({"meleccompetence"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"meleccompetence"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"meleccompetence"})
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="mELECCompetences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialisation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MELECSubCompetence", mappedBy="competence")
     */
    private $mELECSubCompetences;

    public function __construct()
    {
        $this->mELECSubCompetences = new ArrayCollection();
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
     * @return Collection|MELECSubCompetence[]
     */
    public function getMELECSubCompetences(): Collection
    {
        return $this->mELECSubCompetences;
    }

    public function addMELECSubCompetence(MELECSubCompetence $mELECSubCompetence): self
    {
        if (!$this->mELECSubCompetences->contains($mELECSubCompetence)) {
            $this->mELECSubCompetences[] = $mELECSubCompetence;
            $mELECSubCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeMELECSubCompetence(MELECSubCompetence $mELECSubCompetence): self
    {
        if ($this->mELECSubCompetences->contains($mELECSubCompetence)) {
            $this->mELECSubCompetences->removeElement($mELECSubCompetence);
            // set the owning side to null (unless already changed)
            if ($mELECSubCompetence->getCompetence() === $this) {
                $mELECSubCompetence->setCompetence(null);
            }
        }

        return $this;
    }
}
