<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i=1; $i<=100; $i++){

            $product = new Product();
            $product->setName('test1'.$i);
            $product->setDescription('test'.$i.'test'.$i.'test'.$i.'test'.$i.'test'.$i.'test'.$i);
            $product->setPrice(12+$i);
            $product->setDisponible(true);
            $manager->persist($product);
        }


        $manager->flush();
    }
}
