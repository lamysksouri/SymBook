<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;

/**
 * @extends ServiceEntityRepository<Commande>
 *
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    /**
     * Add a new Commande entity to the database.
     *
     * @param Commande $entity
     * @param bool $flush
     * @throws ORMException
     */
    public function add(Commande $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Remove a Commande entity from the database.
     *
     * @param Commande $entity
     * @param bool $flush
     * @throws ORMException
     */
    public function remove(Commande $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findByEtat($etat)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.etat = :etat')
            ->setParameter('etat', $etat)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Commande[] Returns an array of Commande objects
     */
    public function findByDateRange(\DateTimeInterface $startDate, \DateTimeInterface $endDate)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.date BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d'))
            ->setParameter('endDate', $endDate->format('Y-m-d'))
            ->orderBy('c.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Commande|null Returns a single Commande object
     */
    public function findOneBySomeField($value): ?Commande
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.someField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    /**
 * @return int Returns the total number of orders within the specified date range
 */
public function countByDateRange(\DateTimeInterface $startDate, \DateTimeInterface $endDate): int
{
  
    return $this->createQueryBuilder('c')
    ->select('COUNT(c.id)')
    ->andWhere('c.date BETWEEN :startDate AND :endDate')
    ->andWhere('c.etat = :etat')
    ->setParameter('startDate', $startDate->format('Y-m-d'))
    ->setParameter('endDate', $endDate->format('Y-m-d'))
    ->setParameter('etat', 'valide') 
    ->getQuery()
    ->getSingleScalarResult();
    }
    

   

    // Méthode pour obtenir les commandes d'un utilisateur si nécessaire
    public function findCommandesByUser($user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user')
            ->setParameter('user', $user)
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
