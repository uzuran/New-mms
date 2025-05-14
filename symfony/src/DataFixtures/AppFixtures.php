<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Category
        $category = new Category();
        $category->setMaterialId('4.1001');
        $category->setName('Aluminum');  // Use setPpsId instead of setMaterialId
        $manager->persist($category);
        
        $manager->flush();
    }
}
