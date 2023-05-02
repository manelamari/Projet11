<?php

namespace App\Repository;


use App\Entity\Category;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Booking;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @extends ServiceEntityRepository<Voiture>
 *
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }

    public function add(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voiture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voiture
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }




    /**

     * @param Category $category
     */
    public function findvoitbycat(Category $category)
    {
        //version QueryBuilder
        $queryBuilder=$this->createQueryBuilder('v');
        $queryBuilder->andWhere('v.category=:category');
        $queryBuilder->setParameter('category',$category);
        $query=$queryBuilder->getQuery();
        $result=$query->getResult();
        return $result;


    }

    /**
     *
     * recuperer les voitures en lien avec une recherche
     * @param  $D
     * @param $F
     * @return Voiture[]
     */
    public function findSearch($D,$F)
    {



       $qB=$this->createQueryBuilder('v')




           ->leftJoin(Booking::class,'booking',Expr\Join::WITH,'booking.voiture=v.id')
           ->select('v.id')
           ->andWhere('(booking.dateDebut <=:D  AND  booking.dateFin>=:D)
            OR (booking.dateDebut<=:F AND booking.dateFin>=:F) ')

           ->setParameter('D',$D->format('y-m-d'))
            ->setParameter('F',$F->format('y-m-d'))
        ->distinct();

        return $qB->getQuery()->getResult();

    }

public function searchvoinonreserver(){
       $qbn=$this->createQueryBuilder('v')
           ->leftJoin(Booking::class,'booking',Expr\Join::WITH,'booking.voiture=v.id')
->andWhere(' booking.voiture IS  NULL');


    return $qbn->getQuery()->getResult();
}

    /**
     *
     * @return int
     *
     */
    public function countvoiture(){
        $querybuilder=$this->createQueryBuilder('v');
        $querybuilder  ->select('COUNT(v.id) as value');
        return $querybuilder->getQuery()->getOneOrNullResult();
    }




    /**
     * @param array $cars
     * @return Voiture[]
     *
     */
    public function findvoituresdispo( array $cars){

        $qb = $this->createQueryBuilder('v');
        $qb->add('where', $qb->expr()->notIN('v.id', ':value'))
            ->setParameter('value',$cars);
        return $qb->getQuery()->getResult();
    }

/**
 * @param array $cars
 * @return Voiture[]
 *
 */
public function fff( array $cars){

        $qb = $this->createQueryBuilder('v');
        $qb->add('where', $qb->expr()->notIN('v.id', ':value'))
            ->setParameter('value',$cars);
        return $qb->getQuery()->getResult();
}

}
