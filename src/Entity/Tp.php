<?php

namespace App\Entity;

use JMS\Serializer\Annotation AS Serializer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TpRepository")
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Tp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"tp"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"tp"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Review", mappedBy="tp")
     */
    private $reviews;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Task", inversedBy="tps")
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialisation", inversedBy="tps")
     * 
     * @Serializer\Expose()
     * @Serializer\Groups({"tp"})
     */
    private $specialisation;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->task = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->addTp($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            $review->removeTp($this);
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
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->task->contains($task)) {
            $this->task->removeElement($task);
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


    public function __toString(): ?string
    {
        return $this->name;
    }
}
