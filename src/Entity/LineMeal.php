<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LineMealRepository")
 */
class LineMeal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=3)
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meal", inversedBy="lineMeals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meal;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=3)
     */
    private $unit_price;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMeal(): ?Meal
    {
        return $this->meal;
    }

    public function setMeal(?Meal $meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unit_price;
    }

    public function setUnitPrice(string $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getTax(): ?string
    {
        return $this->tax;
    }

    public function setTax(string $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
