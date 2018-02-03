<?php

namespace AppBundle\EntityRepository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function dqlAll()
    {
        return $this->createQueryBuilder('category')
            ->orderBy('category.name', 'ASC')
            ;
    }
}
