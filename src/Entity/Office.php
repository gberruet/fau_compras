<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfficeRepository::class)
 */
class Office
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PurchaseRequest::class, mappedBy="office")
     */
    private $purchaseRequests;

    /**
     * @ORM\OneToOne(targetEntity=OfficeOwner::class, mappedBy="office", cascade={"persist", "remove"})
     */
    private $owner;

    public function __construct()
    {
        $this->purchaseRequests = new ArrayCollection();
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
     * @return Collection|PurchaseRequest[]
     */
    public function getPurchaseRequests(): Collection
    {
        return $this->purchaseRequests;
    }

    public function addPurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        if (!$this->purchaseRequests->contains($purchaseRequest)) {
            $this->purchaseRequests[] = $purchaseRequest;
            $purchaseRequest->setOffice($this);
        }

        return $this;
    }

    public function removePurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        if ($this->purchaseRequests->removeElement($purchaseRequest)) {
            // set the owning side to null (unless already changed)
            if ($purchaseRequest->getOffice() === $this) {
                $purchaseRequest->setOffice(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getOwner(): ?OfficeOwner
    {
        return $this->owner;
    }

    public function setOwner(?OfficeOwner $owner): self
    {
        // unset the owning side of the relation if necessary
        if ($owner === null && $this->owner !== null) {
            $this->owner->setOffice(null);
        }

        // set the owning side of the relation if necessary
        if ($owner !== null && $owner->getOffice() !== $this) {
            $owner->setOffice($this);
        }

        $this->owner = $owner;

        return $this;
    }
}
