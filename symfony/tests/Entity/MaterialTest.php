<?php

// tests/Entity/MaterialTest.php

use App\Entity\Material;
use PHPUnit\Framework\TestCase;

class MaterialTest extends TestCase
{
    public function testMaterialInStorageAfterWriteOff()
    {   # Create a new Material object
        $material = new Material();
        # Set initial values
        $material->setMaterialInStorage(20);
        $material->setWriteOffMaterial(5);
        
        # Call the method to be tested
        $this->assertEquals(20, $material->getMaterialInStorage());
        $this->assertEquals(5, $material->getWriteOffMaterial());
    }
}
