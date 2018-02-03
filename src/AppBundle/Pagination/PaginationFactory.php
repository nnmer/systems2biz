<?php

namespace AppBundle\Pagination;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class PaginationFactory
{
    const PAGESIZE = 10;

    /**
     * @param QueryBuilder $qb
     * @param Request $request
     * @return Pagerfanta
     */
    public function create(QueryBuilder $qb, Request $request)
    {
        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta
            ->setMaxPerPage(self::PAGESIZE)
            ->setCurrentPage($request->query->getInt('page', 1))
        ;

        return $pagerfanta;
    }
}
