<?php

namespace App\Repository;

use App\Entity\Calendrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Calendrier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendrier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendrier[]    findAll()
 * @method Calendrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendrier::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Calendrier $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Calendrier $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    
    public function searchMot($classe,$intervenant)
    { 
        if(!empty($classe)){
            return $this->createQueryBuilder('u')

            ->innerJoin('u.classe', 'c')
        
            ->andWhere('c.id = :classe')
            

            
            ->setParameter('classe', $classe)

           
            ->getQuery()
            ->getResult()
        ;
        }
        if(!empty($intervenant)){
            return $this->createQueryBuilder('u')


            ->leftJoin('u.intervenant', 'i')
            ->andWhere('i.id = :intervenant')

            ->setParameter('intervenant', $intervenant)

            ->getQuery()
            ->getResult()
        ;
        }

    }
 
    public function horaires($start,$end,$classe,$intervenant)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.start < :end')
            ->andWhere('c.end > :start')
            ->andWhere('c.classe = :classe')
            ->andWhere('c.intervenant = :intervenant')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->setParameter('classe', $classe)
            ->setParameter('intervenant', $intervenant)
            ->orderBy('c.id', 'DESC')
           
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Calendrier
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
