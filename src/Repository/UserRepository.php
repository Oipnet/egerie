<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllCandidates()
    {
        return $this->createQueryBuilder('u')
            ->select(['u', 'c', 'e', 'h', 'l'])
            ->join('u.candidate', 'c')
            ->join('c.eye', 'e')
            ->join('c.hair', 'h')
            ->join('c.language', 'l')
            ->where('u.candidate IS NOT NULL')
            ->getQuery()
            ->getResult();
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
