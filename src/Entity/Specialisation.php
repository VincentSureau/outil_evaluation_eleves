<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialisationRepository")
 */
class Specialisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="specialiation")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tp", mappedBy="specialisation")
     */
    private $tps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competence", mappedBy="specialisation")
     */
    private $competence;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->tps = new ArrayCollection();
        $this->competence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setSpecialiation($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getSpecialiation() === $this) {
                $student->setSpecialiation(null);
            }
        }

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
            $tp->setSpecialisation($this);
        }

        return $this;
    }

    public function removeTp(Tp $tp): self
    {
        if ($this->tps->contains($tp)) {
            $this->tps->removeElement($tp);
            // set the owning side to null (unless already changed)
            if ($tp->getSpecialisation() === $this) {
                $tp->setSpecialisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
            $competence->setSpecialisation($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competence->contains($competence)) {
            $this->competence->removeElement($competence);
            // set the owning side to null (unless already changed)
            if ($competence->getSpecialisation() === $this) {
                $competence->setSpecialisation(null);
            }
        }

        return $this;
    }
}
