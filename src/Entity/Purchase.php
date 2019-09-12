<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PurchaseRepository")
 */
class Purchase
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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Delivry")
     * @ORM\JoinColumn(nullable=false)
     */
    private $delivry;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supplier", mappedBy="purchase")
     */
    private $supplier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LinePurchase", mappedBy="purchase")
     */
    private $linePurchases;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
        $this->linePurchases = new ArrayCollection();
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
     * @return Collection|Supplier[]
     */
    public function getSupplier(): Collection
    {
        return $this->supplier;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->supplier->contains($supplier)) {
            $this->supplier[] = $supplier;
            $supplier->setPurchase($this);
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        if ($this->supplier->contains($supplier)) {
            $this->supplier->removeElement($supplier);
            // set the owning side to null (unless already changed)
            if ($supplier->getPurchase() === $this) {
                $supplier->setPurchase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LinePurchase[]
     */
    public function getLinePurchases(): Collection
    {
        return $this->linePurchases;
    }

    public function addLinePurchase(LinePurchase $linePurchase): self
    {
        if (!$this->linePurchases->contains($linePurchase)) {
            $this->linePurchases[] = $linePurchase;
            $linePurchase->setPurchase($this);
        }

        return $this;
    }

    public function removeLinePurchase(LinePurchase $linePurchase): self
    {
        if ($this->linePurchases->contains($linePurchase)) {
            $this->linePurchases->removeElement($linePurchase);
            // set the owning side to null (unless already changed)
            if ($linePurchase->getPurchase() === $this) {
                $linePurchase->setPurchase(null);
            }
        }

        return $this;
    }
}
