<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Magazine;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class MagazineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // initalisation de faker
        $faker = Faker\Factory::create();


        for($i = 0; $i < 20; $i++) {

              // Date aléatoire
            $date = new DateTimeImmutable();
           // $randDate = $date->modify('-'. rand(1, 600) .' days');
            // $randDate = $date->modify('-12 days');

            // Instancie l'entité avec laquelle travailler
              /* @var DateTimeImmutable $dateBetween */
             

            $magazine = new Magazine();
            //$magazine->setName("Name_$i");
            $magazine->setName($faker->name);
            //$magazine->setPrice(rand(6, 30));
            $magazine->setPrice($faker->numberBetween(6, 30));
            //$magazine->setCreatedAt($randDate);  
            $magazine->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 years')));
            $magazine->setCategory($this->getReference("category_". rand(1, 5)));
            // met des donnees en attent till the end of loop
            $manager->persist($magazine); 

        }
        $manager->flush();
    }

    //this method reorders function
    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}





