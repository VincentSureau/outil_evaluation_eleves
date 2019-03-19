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
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="specialisation")
     */
    private $task;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student", "tp", "specialisation"})
     */
    private $name;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->tps = new ArrayCollection();
        $this->task = new ArrayCollection();
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

    /**
     * @return Collection|Task[]
     */
    public function getTask(): Collection
    {
        return $this->task;
    }

    public function addTask(Task $task): self
    {
        if (!$this->task->contains($task)) {
            $this->task[] = $task;
            $task->setSpecialisation($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->task->contains($task)) {
            $this->task->removeElement($task);
            // set the owning side to null (unless already changed)
            if ($task->getSpecialisation() === $this) {
                $task->setSpecialisation(null);
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
}
