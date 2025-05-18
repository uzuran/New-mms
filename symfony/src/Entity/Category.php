<?php
// src/Entity/Category.php

// Strict types.
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Material;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource (
    normalizationContext: ['groups' => ['category:read']],
    denormalizationContext: ['groups' => ['category:write']]
)]

#[ORM\Entity]
class Category
{    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[Groups(['category:read', 'material:read'])]
    private int $id;

    #[ORM\Column(type: "string", length: 50, unique: false)]
    #[Groups(['category:read', 'category:write'])]
    private $materialId;

    #[ORM\Column(type: "string", length: 100)]
    #[Groups(['category:read', 'category:write'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: "category", targetEntity: Material::class, cascade: ["persist", "remove"], orphanRemoval: true)]
    #[Groups(['category:read', 'category:write'])]
    private Collection $materials;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterialId(): ?string
    {
        return $this->materialId;
    }

    public function setMaterialId(string $materialId): self
    {
        $this->materialId = $materialId;
        return $this;
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

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }

    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setCategory($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->removeElement($material)) {
            if ($material->getCategory() === $this) {
                $material->setCategory(null);
            }
        }

        return $this;
    }
}

