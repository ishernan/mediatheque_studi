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
    private $romans;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bandesDessinees;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AlbumsEnfants;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $documentaires;

    /**
     * @ORM\OneToMany(targetEntity=Contenus::class, mappedBy="category")
     */
    private $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRomans(): ?string
    {
        return $this->romans;
    }

    public function setRomans(string $romans): self
    {
        $this->romans = $romans;

        return $this;
    }

    public function getBandesDessinees(): ?string
    {
        return $this->bandesDessinees;
    }

    public function setBandesDessinees(string $bandesDessinees): self
    {
        $this->bandesDessinees = $bandesDessinees;

        return $this;
    }

    public function getAlbumsEnfants(): ?string
    {
        return $this->AlbumsEnfants;
    }

    public function setAlbumsEnfants(string $AlbumsEnfants): self
    {
        $this->AlbumsEnfants = $AlbumsEnfants;

        return $this;
    }

    public function getDocumentaires(): ?string
    {
        return $this->documentaires;
    }

    public function setDocumentaires(string $documentaires): self
    {
        $this->documentaires = $documentaires;

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
