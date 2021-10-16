<?php

namespace App\Entity;

use App\Repository\BorrowedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowedRepository::class)
 */
class Borrowed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $recuperation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiration_date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $returned;

    /**
     * @ORM\OneToOne(targetEntity=reservations::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecuperationDate(): ?\DateTimeInterface
    {
        return $this->recuperation_date;
    }

    public function setRecuperationDate(\DateTimeInterface $recuperation_date): self
    {
        $this->recuperation_date = $recuperation_date;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getReturned(): ?bool
    {
        return $this->returned;
    }

    public function setReturned(bool $returned): self
    {
        $this->returned = $returned;

        return $this;
    }

    public function getIdReservation(): ?reservations
    {
        return $this->id_reservation;
    }

    public function setIdReservation(reservations $id_reservation): self
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }
}
