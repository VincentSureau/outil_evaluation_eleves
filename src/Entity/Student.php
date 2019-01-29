<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation AS Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="students")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $specialisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Srm", inversedBy="students")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $srm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cirfa", inversedBy="students")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $cirfa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School", inversedBy="students")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"student"})
     */
    private $school;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Referent", inversedBy="students")
     */
    private $referent;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Review", cascade={"persist", "remove"})
     */
    private $review;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bordee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getSrm(): ?Srm
    {
        return $this->srm;
    }

    public function setSrm(?Srm $srm): self
    {
        $this->srm = $srm;

        return $this;
    }

    public function getCirfa(): ?Cirfa
    {
        return $this->cirfa;
    }

    public function setCirfa(?Cirfa $cirfa): self
    {
        $this->cirfa = $cirfa;

        return $this;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getReferent(): ?Referent
    {
        return $this->referent;
    }

    public function setReferent(?Referent $referent): self
    {
        $this->referent = $referent;

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstname .' '. $this->lastname;
    }

    public function getBordee(): ?string
    {
        return $this->bordee;
    }

    public function setBordee(string $bordee): self
    {
        $this->bordee = $bordee;

        return $this;
    }
}
