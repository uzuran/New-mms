<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use App\Entity\Material;
use PHPUnit\Framework\TestCase;

class MaterialTest extends TestCase
{
    private Material $material;

    protected function setUp(): void
    {
        $this->material = new Material();
    }

    public function testCreatedAtIsInitialized()
    {
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->material->getCreatedAt());
    }

    public function testSetAndGetCategory()
    {
        $category = new Category();
        $category->setName('1.4301')->setMaterialId('Stainless Steel');

        $this->material->setCategory($category);

        $this->assertSame($category, $this->material->getCategory());
    }

    public function testSetAndGetPpsId()
    {
        $this->material->setPpsId('0119106');
        $this->assertSame('0119106', $this->material->getPpsId());
    }

    public function testSetAndGetDimensions()
    {
        $this->material->setMaterialThickness(5.0)
                       ->setXSize(3000.0)
                       ->setYSize(1500.0);

        $this->assertSame(5.0, $this->material->getMaterialThickness());
        $this->assertSame(3000.0, $this->material->getXSize());
        $this->assertSame(1500.0, $this->material->getYSize());
    }

    public function testSetAndGetQuantities()
    {
        $this->material->setOrderedMaterial(500.0)
                       ->setMaterialInStorage(300.0)
                       ->setWriteOffMaterial(10.0);

        $this->assertSame(500.0, $this->material->getOrderedMaterial());
        $this->assertSame(300.0, $this->material->getMaterialInStorage());
        $this->assertSame(10.0, $this->material->getWriteOffMaterial());
    }

    public function testSetAndGetUpdatedAt()
    {
        $now = new \DateTime();
        $this->material->setUpdatedAt($now);

        $this->assertSame($now, $this->material->getUpdatedAt());
    }
}
