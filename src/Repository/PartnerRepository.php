<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Partner::class);
    }


    public function findActive()
    {
        return $this->createQueryBuilder('p')
            ->where('p.isActive = :is_active')
            ->setParameter('is_active', true)
            ->getQuery()
            ->getResult()
        ;
    }
}
