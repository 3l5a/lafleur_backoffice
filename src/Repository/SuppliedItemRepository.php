<?php

namespace App\Repository;

use App\Entity\SuppliedItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuppliedItem>
 *
 * @method SuppliedItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuppliedItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuppliedItem[]    findAll()
 * @method SuppliedItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuppliedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuppliedItem::class);
    }

    public function save(SuppliedItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SuppliedItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SuppliedItem[] Returns an array of SuppliedItem objects
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

//    public function findOneBySomeField($value): ?SuppliedItem
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
