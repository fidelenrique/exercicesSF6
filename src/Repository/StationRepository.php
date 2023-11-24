<?php

namespace App\Repository;

use App\Entity\Station;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Station>
 *
 * @method Station|null find($id, $lockMode = null, $lockVersion = null)
 * @method Station|null findOneBy(array $criteria, array $orderBy = null)
 * @method Station[]    findAll()
 * @method Station[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Station::class);
    }

    public function paginationQuery($value=null): \Doctrine\ORM\QueryBuilder
    {
        $query = $this->createQueryBuilder('s');

        if (!is_null($value)) {
            $query->select('s');
            $query->andWhere('s.ligne = :val')
                  ->setParameter('val', $value);
        }

        $query->orderBy('s.id', 'ASC')
        ->getQuery();

        return $query;
    }

    /**
     * @return Station[] Returns an array of Station objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Station[]
     */
    public function ratpLines(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT DISTINCT s.ligne
            FROM App\Entity\Station s
            ORDER BY s.ligne ASC'
        );

        return $query->getResult();
    }

    public function transitInLine()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT DISTINCT s.nomlong, COUNT(s.nomlong) AS transit 
            FROM App\Entity\Station s
            GROUP BY s.nomlong'
        );

        return $query->getResult();
    }

//    public function findOneBySomeField($value): ?Station
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
