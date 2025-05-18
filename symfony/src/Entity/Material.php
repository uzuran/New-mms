<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource (
    normalizationContext: ['groups' => ['material:read']],
    denormalizationContext: ['groups' => ['material:write']]
)]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]

#[ApiFilter(SearchFilter::class, properties: [
    'materialId' => 'partial',
    'category.name' => 'exact'
])]

class Material
{   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(['material:read', 'category:read'])]
    private int $id;
    
    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "string", length: 100)]
    private string $ppsId;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $materialThickness;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $xSize;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $ySize;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $orderedMaterial = 0;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $materialInStorage = 0;

    #[Groups(['material:read', 'material:write', 'category:write'])]
    #[ORM\Column(type: "float")]
    private float $writeOffMaterial = 0;

    #[Groups(['material:read', 'material:write'])]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'materials')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

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

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
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
