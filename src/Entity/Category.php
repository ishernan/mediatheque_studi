<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     private $classification;


    /**
     * @ORM\OneToMany(targetEntity=Contenus::class, mappedBy="category")
     */
    private $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getClassification();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassification(): ?string
    {
        return $this->classification;
    }

    public function setClassification(string $classification): self
    {
        $this->classification = $classification;

        return $this;
    }



    /**
     * @return Collection|Contenus[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Contenus $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
            $item->setCategory($this);
        }

        return $this;
    }

    public function removeItem(Contenus $item): self
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCategory() === $this) {
                $item->setCategory(null);
            }
        }

        return $this;
    }
}
