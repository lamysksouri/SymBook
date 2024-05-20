<?php

namespace App\Repository;

use App\Entity\ClientLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientLivre>
 *
 * @method ClientLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientLivre[]    findAll()
 * @method ClientLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientLivre::class);
    }

//    /**
//     * @return ClientLivre[] Returns an array of ClientLivre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClientLivre
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
