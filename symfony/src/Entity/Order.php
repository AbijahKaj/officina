<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="decimal", precision=30, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "The date should be greater than today!",
     *      groups={"new_order"}
     * )
     */
    private $from_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "The date should be greater than today!",
     *      groups={"new_order"}
     * )
     * @Assert\Expression(
     *     "this.getUntilDate() >= this.getFromDate()",
     *     message="The from date should start before the end date!",
     *     groups={"new_order"}
     * )
     */
    private $until_date;

    /**
     * @ORM\ManyToOne(targetEntity="Office")
     */
    private $office;

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

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
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

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(Office $office): self
    {
        $this->office = $office;

        return $this;
    }
}
