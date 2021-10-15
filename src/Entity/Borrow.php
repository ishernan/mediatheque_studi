<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowRepository::class)
 */
class Borrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="borrows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $borrow_Date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=BorrowDetails::class, mappedBy="borrow")
     */
    private $borrowDetails;

    public function __construct()
    {
        $this->borrowDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getBorrowDate(): ?\DateTimeInterface
    {
        return $this->borrow_Date;
    }

    public function setBorrowDate(\DateTimeInterface $borrow_Date): self
    {
        $this->borrow_Date = $borrow_Date;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|BorrowDetails[]
     */
    public function getBorrowDetails(): Collection
    {
        return $this->borrowDetails;
    }

    public function addBorrowDetail(BorrowDetails $borrowDetail): self
    {
        if (!$this->borrowDetails->contains($borrowDetail)) {
            $this->borrowDetails[] = $borrowDetail;
            $borrowDetail->setBorrow($this);
        }

        return $this;
    }

    public function removeBorrowDetail(BorrowDetails $borrowDetail): self
    {
        if ($this->borrowDetails->removeElement($borrowDetail)) {
            // set the owning side to null (unless already changed)
            if ($borrowDetail->getBorrow() === $this) {
                $borrowDetail->setBorrow(null);
            }
        }

        return $this;
    }
}
