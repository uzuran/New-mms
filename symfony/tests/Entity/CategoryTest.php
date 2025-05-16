<?php

// tests/Entity/MaterialTest.php

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{   
    private Category $category;

    protected function setUp(): void
    {
        $this->category = new Category();
    }

    
    public function testMaterialId()
    {   
        # Material ID
        $materialId = "1.4301";
       
        # Set initial values
        $this->category->setMaterialId($materialId);
        # Call the method to be tested
        $this->assertEquals($materialId, $this->category->getMaterialId());
        
    }

        public function testName()
    {
        $name = 'Stainless Steel';

        $this->category->setName($name);
        $this->assertSame($name, $this->category->getName());
    }

    
    public function testInitialIdIsNull()
    {
        $this->assertNull($this->category->getId());
    }
}
