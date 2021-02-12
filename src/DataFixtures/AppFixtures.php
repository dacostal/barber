<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Service;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Validator\Constraints\Time;

class AppFixtures extends Fixture
{
    public $t = ["barbe","cheuveux","combo"]; 

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');
        for($i = 0 ; $i<10 ; $i++)
        {
            $title = $faker->sentence(3);
            $description = $faker->sentence();
            $time = '00:'.mt_rand(1,59).':00';
            $price = $faker->numberBetween($min = 10, $max = 100);
            $category = $this->t[mt_rand(0,2)];

            $s = new Service();

            $s->setTitle($title)
             ->setDescription($description)
             ->setTime(new \DateTime($time))
             ->setPrice($price)
            ->setCategory($category);
        
         $manager->persist($s);
        }
        $manager->flush();
    }
}
