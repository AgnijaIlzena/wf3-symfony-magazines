<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i < 6; $i++){
          // initalisation de faker
          $faker = Faker\Factory::create();

         $category = new Category();
         $category->setName($faker->word);
         $category->setColor($faker->hexcolor);
         $this->addReference("category_$i", $category);

         $manager->persist($category);
        }

        $manager->flush();
    }
}
