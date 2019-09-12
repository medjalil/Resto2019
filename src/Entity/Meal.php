<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MealRepository")
 */
class Meal
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
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Delivry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $delivry;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LineMeal", mappedBy="meal")
     */
    private $lineMeals;

    public function __construct()
    {
        $this->lineMeals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDelivry(): ?Delivry
    {
        return $this->delivry;
    }

    public function setDelivry(?Delivry $delivry): self
    {
        $this->delivry = $delivry;

        return $this;
    }

    /**
     * @return Collection|LineMeal[]
     */
    public function getLineMeals(): Collection
    {
        return $this->lineMeals;
    }

    public function addLineMeal(LineMeal $lineMeal): self
    {
        if (!$this->lineMeals->contains($lineMeal)) {
            $this->lineMeals[] = $lineMeal;
            $lineMeal->setMeal($this);
        }

        return $this;
    }

    public function removeLineMeal(LineMeal $lineMeal): self
    {
        if ($this->lineMeals->contains($lineMeal)) {
            $this->lineMeals->removeElement($lineMeal);
            // set the owning side to null (unless already changed)
            if ($lineMeal->getMeal() === $this) {
                $lineMeal->setMeal(null);
            }
        }

        return $this;
    }
}
