<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class AreaRepository extends EntityRepository
{
    public function getAreasList(){

        $queryBuilder = $this->createQueryBuilder('a')
            ->from('App:Area', 'a')
            ->where('a.deleteTime IS NULL')
            ->orderBy('a.id', 'ASC')
        ;

        return $queryBuilder->getQuery();
    }
}