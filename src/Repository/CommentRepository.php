<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findLastByoneComment(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_comments ORDER BY id DESC LIMIT 1;";
        $statement = $connection->executeQuery($sql);
        $oneCommentArr = $statement->fetchAllAssociative();
        dump($oneCommentArr);
        return $oneCommentArr;
     }
     public function findLastByTwoComment(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_comments ORDER BY id DESC LIMIT 1,1;";
        $statement = $connection->executeQuery($sql);
        $twoCommentArr = $statement->fetchAllAssociative();
        dump($twoCommentArr);
        return $twoCommentArr;
     }
     public function findLastByThreeComment(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_comments ORDER BY id DESC LIMIT 2,1;";
        $statement = $connection->executeQuery($sql);
        $threeCommentArr = $statement->fetchAllAssociative();
        dump($threeCommentArr);
        return $threeCommentArr;
     }
    /*
    public function findOneBySomeField($value): ?Comment
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
