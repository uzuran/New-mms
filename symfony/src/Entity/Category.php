<?php
// src/Entity/Category.php

// src/Entity/Category.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private $materialId;

    #[ORM\Column(type: "string", length: 100)]
    private $name;

    // Getters and Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterialId(): ?string
    {
        return $this->materialId;
    }

    public function setMaterialId(string $ppsId): self
    {
        $this->materialId = $ppsId;
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
}

