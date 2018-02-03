<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [];
        for ($i = 0; $i < 20; $i++) {
            $category = new Category();
            $category->setName('category-'.$i);
            $manager->persist($category);

            $categories[$i] = $category;
        }
        $manager->flush();

        for ($i = 0; $i < 120; $i++) {
            $product = new Product();
            $product
                ->setName('product-'.$i)
                ->setPrice(rand(1, 100))
                ->setQuantity(rand(0, 20))
                ->setSku('sku-'.$i)
            ;

            for ($j = 0; $j < rand(0, 20); $j++) {
                $product->addCategory($categories[$j]);
            }

            $manager->persist($product);
        }

        $manager->flush();
    }
}
