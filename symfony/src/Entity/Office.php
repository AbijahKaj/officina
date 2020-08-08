<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfficeRepository::class)
 */
class Office
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="integer")
     */
    private $lat;

    /**
     * @ORM\Column(type="integer")
     */
    private $lon;


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

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getLat(): ?int
    {
        return $this->lat;
    }

    public function setLat(int $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?int
    {
        return $this->lon;
    }

    public function setLon(int $lon): self
    {
        $this->lon = $lon;

        return $this;
    }
}
