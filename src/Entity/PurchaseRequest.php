<?php

namespace App\Entity;

use App\Repository\PurchaseRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PurchaseRequestRepository::class)
 */
class PurchaseRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Operation::class, inversedBy="purchaseRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=Hiring::class, inversedBy="purchaseRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hiring;

    /**
     * @ORM\ManyToOne(targetEntity=Office::class, inversedBy="purchaseRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $office;

    /**
     * @ORM\ManyToOne(targetEntity=Term::class, inversedBy="purchaseRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private $term;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $purchase_reason;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $estimated_price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(?Operation $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getHiring(): ?Hiring
    {
        return $this->hiring;
    }

    public function setHiring(?Hiring $hiring): self
    {
        $this->hiring = $hiring;

        return $this;
    }

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(?Office $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getTerm(): ?Term
    {
        return $this->term;
    }

    public function setTerm(?Term $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function getPurchaseReason(): ?string
    {
        return $this->purchase_reason;
    }

    public function setPurchaseReason(string $purchase_reason): self
    {
        $this->purchase_reason = $purchase_reason;

        return $this;
    }

    public function getEstimatedPrice(): ?string
    {
        return $this->estimated_price;
    }

    public function setEstimatedPrice(?string $estimated_price): self
    {
        $this->estimated_price = $estimated_price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
