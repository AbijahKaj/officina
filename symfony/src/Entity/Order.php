<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $approved;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $remarks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $booked_by;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $from_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $until_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $office_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(?bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }

    public function getBookedBy(): ?int
    {
        return $this->booked_by;
    }

    public function setBookedBy(?int $booked_by): self
    {
        $this->booked_by = $booked_by;

        return $this;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->from_date;
    }

    public function setFromDate(?\DateTimeInterface $from_date): self
    {
        $this->from_date = $from_date;

        return $this;
    }

    public function getUntilDate(): ?\DateTimeInterface
    {
        return $this->until_date;
    }

    public function setUntilDate(?\DateTimeInterface $until_date): self
    {
        $this->until_date = $until_date;

        return $this;
    }

    public function getOfficeId(): ?int
    {
        return $this->office_id;
    }

    public function setOfficeId(int $office_id): self
    {
        $this->office_id = $office_id;

        return $this;
    }
}
