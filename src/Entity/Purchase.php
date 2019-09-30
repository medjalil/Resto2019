<?php

namespace App\Entity;
use App\Entity\LinePurchase;
use App\Entity\Supplier;
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
     * @ORM\OneToMany(targetEntity="App\Entity\LinePurchase", mappedBy="purchase",cascade={"persist"})
     */
    private $linePurchase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="purchases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

    public function __construct()
    {
        $this->linePurchase = new ArrayCollection();
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
     * @return Collection|LinePurchase[]
     */
    public function getLinePurchase(): Collection
    {
        return $this->linePurchase;
    }

    public function addLinePurchase(LinePurchase $linePurchase): self
    {
        if (!$this->linePurchase->contains($linePurchase)) {
            $this->linePurchase[] = $linePurchase;
            $linePurchase->setPurchase($this);
        }

        return $this;
    }

    public function removeLinePurchase(LinePurchase $linePurchase): self
    {
        if ($this->linePurchase->contains($linePurchase)) {
            $this->linePurchase->removeElement($linePurchase);
            // set the owning side to null (unless already changed)
            if ($linePurchase->getPurchase() === $this) {
                $linePurchase->setPurchase(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return  $this-> number;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
