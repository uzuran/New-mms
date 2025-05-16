<?php

// tests/Entity/MaterialTest.php

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testMaterialInStorageAfterWriteOff()
    {   # Create a new Material object
        $category = new Category();
        # Set initial values
        $category->setMaterialId("1.4301");
        $category->setName("Nerezová ocel");
        
        # Call the method to be tested
        $this->assertEquals("1.4301", $category->getMaterialId());
        $this->assertEquals("Nerezová ocel", $category->getName());
    }
}
