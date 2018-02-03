<?php

namespace AppBundle\EntityRepository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function dqlAll()
    {
        return $this->createQueryBuilder('category')
            ->orderBy('category.name', 'ASC')
            ;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->dqlAll()->getQuery()->getResult();
    }
}
