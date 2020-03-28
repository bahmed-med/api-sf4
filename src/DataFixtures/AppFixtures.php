<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=1; $i<=200; $i++){

            $product = new Product();
            $product->setName($faker->words(5, true));
            $product->setDescription($faker->sentences(3, true));
            $product->setPrice($faker->numberBetween(12, 350));
            $product->setDisponible($faker->boolean(33));

            $manager->persist($product);
        }


        $manager->flush();
    }
}
