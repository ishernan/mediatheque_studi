<?php

namespace App\Entity;

use App\Repository\IntervalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntervalRepository::class)
 * @ORM\Table(name="`interval`")
 */
class Interval
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
    private $type_interval;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $interval_value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeInterval(): ?string
    {
        return $this->type_interval;
    }

    public function setTypeInterval(string $type_interval): self
    {
        $this->type_interval = $type_interval;

        return $this;
    }

    public function getIntervalValue(): ?string
    {
        return $this->interval_value;
    }

    public function setIntervalValue(string $interval_value): self
    {
        $this->interval_value = $interval_value;

        return $this;
    }
}
