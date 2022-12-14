<?php

namespace App\Repository;

use App\Entity\Etudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiants|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiants|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiants[]    findAll()
 * @method Etudiants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiants::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Etudiants $entity, bool $flush = true): void
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
    public function remove(Etudiants $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findByclasse($classe)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.classes', 'a')
    
            ->where('a.id = :classe')
            ->setParameter('classe', $classe)
       
    
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByclassesem($classe)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.classes', 'a')
 
    
            ->where('a.id = :classe')
    
            ->setParameter('classe', $classe)
    
    
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByclasseName($classe)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.classes', 'a')
    
            ->where('a.nom = :classe')
            ->setParameter('classe', $classe)
       
    
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByUser($user)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.user', 'a')
            ->where('a.id = :user')
            ->setParameter('user', $user)
       
      
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchMot($value,$module,$classe)
    {






        if(!empty($value)){

            return $this->createQueryBuilder('u')
        
            ->orWhere('u.nom LIKE :value')
            ->orWhere('u.prenom LIKE :value')
            ->orWhere('u.email LIKE :value')
            ->orWhere('u.telephone LIKE :value')
            ->setParameter('value', '%'.$value.'%')
  

            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }


        if(!empty($module)){

            return $this->createQueryBuilder('u')

          

            ->andWhere('u.entreprise = :module')

            ->setParameter('module', $module)

            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }


        if(!empty($classe)){

            return $this->createQueryBuilder('u')
    
            ->andWhere('u.classes = :classe')

            ->setParameter('classe', $classe)

            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        }


       
    }

    /*
    public function findOneBySomeField($value): ?Etudiants
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}