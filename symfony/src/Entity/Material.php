<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Material
{   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(type: "string", length: 100)]
    private string $materialId;

    #[ORM\Column(type: "float")]
    private float $materialThickness;

    #[ORM\Column(type: "float")]
    private float $xSize;

    #[ORM\Column(type: "float")]
    private float $ySize;

    #[ORM\Column(type: "float")]
    private float $orderedMaterial = 0;

    #[ORM\Column(type: "float")]
    private float $materialInStorage = 0;

    #[ORM\Column(type: "float")]
    private float $writeOffMaterial = 0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    // Getters and Setters

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }
    
    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getMaterialId(): string
    {
        return $this->materialId;
    }

    public function setMaterialId(string $materialId): self
    {
        $this->materialId = $materialId;
        return $this;
    }

    public function getMaterialThickness(): float
    {
        return $this->materialThickness;
    }

    public function setMaterialThickness(float $materialThickness): self
    {
        $this->materialThickness = $materialThickness;
        return $this;
    }

    public function getXSize(): float
    {
        return $this->xSize;
    }

    public function setXSize(float $xSize): self
    {
        $this->xSize = $xSize;
        return $this;
    }

    public function getYSize(): float
    {
        return $this->ySize;
    }

    public function setYSize(float $ySize): self
    {
        $this->ySize = $ySize;
        return $this;
    }

    public function getOrderedMaterial(): float
    {
        return $this->orderedMaterial;
    }

    public function setOrderedMaterial(float $orderedMaterial): self
    {
        $this->orderedMaterial = $orderedMaterial;
        return $this;
    }

    public function getMaterialInStorage(): float
    {
        return $this->materialInStorage;
    }

    public function setMaterialInStorage(float $materialInStorage): self
    {
        $this->materialInStorage = $materialInStorage;
        return $this;
    }

    public function getWriteOffMaterial(): float
    {
        return $this->writeOffMaterial;
    }

    public function setWriteOffMaterial(float $writeOffMaterial): self
    {
        $this->writeOffMaterial = $writeOffMaterial;
        return $this;
    }

        public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}
