<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Material;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Category
        $category = new Category();
        $category->setMaterialId('3.3535');
        $category->setName('Aluminum');  // Use setPpsId instead of setMaterialId
        $manager->persist($category);

        // Create Material
        $material = new Material();
        $material->setPpsId('3.3535');
        $material->setMaterialThickness(2.0);
        $material->setXSize(3000.0);
        $material->setYSize(1500.0);
        $material->setOrderedMaterial(50);
        $material->setMaterialInStorage(45);
        $material->setWriteOffMaterial(5);
        $material->setCategory($category);

        // Persist Material
        $manager->persist($material);
        
        $manager->flush();
    }
}
