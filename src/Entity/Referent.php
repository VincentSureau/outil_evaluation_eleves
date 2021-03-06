<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ReferentRepository")
 * 
 * @Serializer\ExclusionPolicy("all")
 * @Serializer\VirtualProperty(
 *     "name",
 *     exp="object.__toString()",
 *     options={
 *          @Serializer\SerializedName("name"),
 *          @Serializer\Groups({"student"})
 *     }
 *  )
 */
class Referent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student", "referent"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"referent"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"referent"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"referent"})
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="referent")
     */
    private $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
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
            $student->setReferent($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getReferent() === $this) {
                $student->setReferent(null);
            }
        }

        return $this;
    }

    /*
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->gender .' '. $this->lastname;
    }
}
