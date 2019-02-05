<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tp", inversedBy="reviews")
     */
    private $tp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $report;

    /**
     * @ORM\Column(type="array")
     */
    private $notes = [];

    public function __construct()
    {
        $this->tp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Tp[]
     */
    public function getTp(): Collection
    {
        return $this->tp;
    }

    public function addTp(Tp $tp): self
    {
        if (!$this->tp->contains($tp)) {
            $this->tp[] = $tp;
        }

        return $this;
    }

    public function removeTp(Tp $tp): self
    {
        if ($this->tp->contains($tp)) {
            $this->tp->removeElement($tp);
        }

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(?string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getNotes(): ?array
    {
        return $this->notes;
    }

    public function setNotes(array $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
