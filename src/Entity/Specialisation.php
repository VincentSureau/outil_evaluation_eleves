<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialisationRepository")
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Specialisation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"specialisation"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="specialisation")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tp", mappedBy="specialisation")
     */
    private $tps;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student", "tp", "specialisation"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SNCompetence", mappedBy="specialisation")
     */
    private $sNCompetences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MELECCompetence", mappedBy="specialisation")
     */
    private $mELECCompetences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MELECTask", mappedBy="specialisation")
     */
    private $mELECTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SNTask", mappedBy="specialisation")
     */
    private $sNTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MELECSubCompetence", mappedBy="specialisation")
     */
    private $melecSubCompetences;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->tps = new ArrayCollection();
        $this->sNCompetences = new ArrayCollection();
        $this->mELECCompetences = new ArrayCollection();
        $this->mELECTasks = new ArrayCollection();
        $this->sNTasks = new ArrayCollection();
        $this->melecSubCompetences = new ArrayCollection();
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
            $student->setSpecialisation($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getSpecialisation() === $this) {
                $student->setSpecialisation(null);
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

    public function __toString(): string
    {
        return $this->name;
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
     * @return Collection|SNCompetence[]
     */
    public function getSNCompetences(): Collection
    {
        return $this->sNCompetences;
    }

    public function addSNCompetence(SNCompetence $sNCompetence): self
    {
        if (!$this->sNCompetences->contains($sNCompetence)) {
            $this->sNCompetences[] = $sNCompetence;
            $sNCompetence->setSpecialisation($this);
        }

        return $this;
    }

    public function removeSNCompetence(SNCompetence $sNCompetence): self
    {
        if ($this->sNCompetences->contains($sNCompetence)) {
            $this->sNCompetences->removeElement($sNCompetence);
            // set the owning side to null (unless already changed)
            if ($sNCompetence->getSpecialisation() === $this) {
                $sNCompetence->setSpecialisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MELECCompetence[]
     */
    public function getMELECCompetences(): Collection
    {
        return $this->mELECCompetences;
    }

    public function addMELECCompetence(MELECCompetence $mELECCompetence): self
    {
        if (!$this->mELECCompetences->contains($mELECCompetence)) {
            $this->mELECCompetences[] = $mELECCompetence;
            $mELECCompetence->setSpecialisation($this);
        }

        return $this;
    }

    public function removeMELECCompetence(MELECCompetence $mELECCompetence): self
    {
        if ($this->mELECCompetences->contains($mELECCompetence)) {
            $this->mELECCompetences->removeElement($mELECCompetence);
            // set the owning side to null (unless already changed)
            if ($mELECCompetence->getSpecialisation() === $this) {
                $mELECCompetence->setSpecialisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MELECTask[]
     */
    public function getMELECTasks(): Collection
    {
        return $this->mELECTasks;
    }

    public function addMELECTask(MELECTask $mELECTask): self
    {
        if (!$this->mELECTasks->contains($mELECTask)) {
            $this->mELECTasks[] = $mELECTask;
            $mELECTask->setSpecialisation($this);
        }

        return $this;
    }

    public function removeMELECTask(MELECTask $mELECTask): self
    {
        if ($this->mELECTasks->contains($mELECTask)) {
            $this->mELECTasks->removeElement($mELECTask);
            // set the owning side to null (unless already changed)
            if ($mELECTask->getSpecialisation() === $this) {
                $mELECTask->setSpecialisation(null);
            }
        }

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
            $sNTask->setSpecialisation($this);
        }

        return $this;
    }

    public function removeSNTask(SNTask $sNTask): self
    {
        if ($this->sNTasks->contains($sNTask)) {
            $this->sNTasks->removeElement($sNTask);
            // set the owning side to null (unless already changed)
            if ($sNTask->getSpecialisation() === $this) {
                $sNTask->setSpecialisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MELECSubCompetence[]
     */
    public function getMelecSubCompetences(): Collection
    {
        return $this->melecSubCompetences;
    }

    public function addMelecSubCompetence(MELECSubCompetence $melecSubCompetence): self
    {
        if (!$this->melecSubCompetences->contains($melecSubCompetence)) {
            $this->melecSubCompetences[] = $melecSubCompetence;
            $melecSubCompetence->setSpecialisation($this);
        }

        return $this;
    }

    public function removeMelecSubCompetence(MELECSubCompetence $melecSubCompetence): self
    {
        if ($this->melecSubCompetences->contains($melecSubCompetence)) {
            $this->melecSubCompetences->removeElement($melecSubCompetence);
            // set the owning side to null (unless already changed)
            if ($melecSubCompetence->getSpecialisation() === $this) {
                $melecSubCompetence->setSpecialisation(null);
            }
        }

        return $this;
    }
}
