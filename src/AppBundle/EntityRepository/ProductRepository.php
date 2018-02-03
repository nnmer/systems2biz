<?php

namespace AppBundle\EntityRepository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function dqlByCategory(Category $category)
    {
        return $this->createQueryBuilder('product')
            ->leftJoin('product.categories', 'categories')
            ->where('categories.slug = :slug')
            ->orderBy('product.name', 'ASC')
            ->setParameters([
                'slug' => $category->getSlug()
            ]);
    }
}
