<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 164)]
    private ?string $model = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $year_registration = null;

    #[ORM\Column]
    private ?int $km_traveled = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Picture $picture_id = null;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'car_id')]
    private Collection $user_status_id;

    public function __construct()
    {
        $this->user_status_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYearRegistration(): ?\DateTimeInterface
    {
        return $this->year_registration;
    }

    public function setYearRegistration(\DateTimeInterface $year_registration): static
    {
        $this->year_registration = $year_registration;

        return $this;
    }

    public function getKmTraveled(): ?int
    {
        return $this->km_traveled;
    }

    public function setKmTraveled(int $km_traveled): static
    {
        $this->km_traveled = $km_traveled;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getPictureId(): ?Picture
    {
        return $this->picture_id;
    }

    public function setPictureId(?Picture $picture_id): static
    {
        $this->picture_id = $picture_id;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getUserStatusId(): Collection
    {
        return $this->user_status_id;
    }

    public function addUserStatusId(Order $userStatusId): static
    {
        if (!$this->user_status_id->contains($userStatusId)) {
            $this->user_status_id->add($userStatusId);
            $userStatusId->setCarId($this);
        }

        return $this;
    }

    public function removeUserStatusId(Order $userStatusId): static
    {
        if ($this->user_status_id->removeElement($userStatusId)) {
            // set the owning side to null (unless already changed)
            if ($userStatusId->getCarId() === $this) {
                $userStatusId->setCarId(null);
            }
        }

        return $this;
    }
}
