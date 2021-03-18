<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Barber;
use App\Entity\Service;
use App\Entity\Customer;
use Faker\Provider\fr_FR\PhoneNumber;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public $t = ["barbe","cheuveux","combo"];
    private $encode;
 
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encode = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');
        $f = $faker = Factory::create();
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

        for($i = 0; $i<10 ; $i++)
        {
            $c = new Customer();
            $email = $faker->email();
            $password=$this->encode->encodePassword($c,"azerty" );
            $firstName = $faker->firstName();
            $phone = '060000000'.$i;
            $lastName= $faker->lastName();
            $adress = $faker->streetAddress();
            $zipcode = "75019";

            
            $c ->setEmail($email)
            ->setPassword($password)
            ->setFirstName($firstName)
            ->setPhone($phone)
            ->setLastName($lastName)
            ->setAddress($adress)
            ->setZipcode($zipcode);

            $manager->persist($c);
        }

        for($i = 0; $i<10 ; $i++)
        {
            $b = new Barber();
            $email = $faker->email();
            $password=$this->encode->encodePassword($c,"azerty" );
            $firstName = $faker->firstName();
            $phone = '060000000'.$i;
            $isadmin=false;

            
            $b ->setEmail($email)
            ->setPassword($password)
            ->setFirstName($firstName)
            ->setPhone($phone)
            ->setIsAdmin($isadmin);

            $manager->persist($b);
        }
        
       

        $manager->flush();
    }
}
