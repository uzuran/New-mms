<?php

namespace App\Entity;

use App\Entity\Category;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\{
    ApiResource, Get, GetCollection, Post, Put, Patch, Delete, ApiFilter
};
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['material:read']],
    denormalizationContext: ['groups' => ['material:write']],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'materialId' => 'partial',
    'category.name' => 'exact',
])]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['material:read', 'category:read'])]
    private ?int $id = null;

    
    #[Assert\NotBlank(message: "Material pps ID cannot be empty.")]
    #[Assert\Length(
        max: 100,
        maxMessage: "Material pps ID cannot be longer than {{ limit }} characters."
    )]
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private string $ppsId = '';

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $materialThickness = 0;

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $xSize = 0;

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $ySize = 0;

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $orderedMaterial = 0;

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $materialInStorage = 0;

    #[ORM\Column(type: 'float')]
    #[Groups(['material:read', 'material:write', 'category:write'])]
    private float $writeOffMaterial = 0;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'materials')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['material:read', 'material:write'])]
    private ?Category $category = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPpsId(): string
    {
        return $this->ppsId;
    }

    public function setPpsId(string $ppsId): self
    {
        $this->ppsId = $ppsId;
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
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
