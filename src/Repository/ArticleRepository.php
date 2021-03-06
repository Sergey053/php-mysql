<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findLastByArticle(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_articles ORDER BY id DESC LIMIT 6";
        $statement = $connection->executeQuery($sql);
        $resultArr = $statement->fetchAllAssociative();
        dump($resultArr);
        return $resultArr;
    }

    public function findLastByThreeArticle(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_articles ORDER BY id DESC LIMIT 3";
        $statement = $connection->executeQuery($sql);
        $threeArticleArr = $statement->fetchAllAssociative();
        dump($threeArticleArr);
        return $threeArticleArr;
    }
//    последняя статья
    public function findLastByOneArticle(){
        $connection = $this->getEntityManager()->getConnection();
        $sql = "SELECT * FROM tb_articles ORDER BY id DESC LIMIT 1;";
        $statement = $connection->executeQuery($sql);
        $oneArticleArr = $statement->fetchAllAssociative();
        dump($oneArticleArr);
        return $oneArticleArr;
    }

 //    предпоследняя статья
 public function findLastByTwoArticle(){
    $connection = $this->getEntityManager()->getConnection();
    $sql = "SELECT * FROM tb_articles ORDER BY id DESC LIMIT 1,1;";
    $statement = $connection->executeQuery($sql);
    $twoArticleArr = $statement->fetchAllAssociative();
    dump($twoArticleArr);
    return $twoArticleArr;
 }
  //   2 предпоследняя статья
  public function findLastByFreeArticle(){
    $connection = $this->getEntityManager()->getConnection();
    $sql = "SELECT * FROM tb_articles ORDER BY id DESC LIMIT 1,2;";
    $statement = $connection->executeQuery($sql);
    $freeArticleArr = $statement->fetchAllAssociative();
    dump($freeArticleArr);
    return $freeArticleArr;
 }




public function findAllByType(string $articleType){
    return $this->createQueryBuilder('b')
    ->andWhere('b.type = :type')
    ->setParameter('type', $articleType)
    ->getQuery()
    ->getResult();
}


    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
