<?php

namespace App\Repository;

use App\Entity\TableauAbsencesintervenants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TableauAbsencesintervenants>
 *
 * @method TableauAbsencesintervenants|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableauAbsencesintervenants|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableauAbsencesintervenants[]    findAll()
 * @method TableauAbsencesintervenants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableauAbsencesintervenantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableauAbsencesintervenants::class);
    }

    public function add(TableauAbsencesintervenants $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TableauAbsencesintervenants $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TableauAbsencesintervenants[] Returns an array of TableauAbsencesintervenants objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TableauAbsencesintervenants
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}