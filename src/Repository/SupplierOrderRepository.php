<?php

namespace App\Repository;

use App\Entity\SupplierOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SupplierOrder>
 *
 * @method SupplierOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupplierOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupplierOrder[]    findAll()
 * @method SupplierOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupplierOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupplierOrder::class);
    }

    public function save(SupplierOrder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SupplierOrder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SupplierOrder[] Returns an array of SupplierOrder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SupplierOrder
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
