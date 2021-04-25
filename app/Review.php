<?php


namespace app;
use PDO;

class Review
{
    use DBLogger;
    private PDO $pdo;
    private string $tableName = "reviews";

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getAllRecords()
    {
        $stmt = $this->pdo->query('SELECT r.id, r.author_id, r.product_id, text, created_at, ri.image,u.login,u.image as user_image FROM users u INNER JOIN reviews r on r.author_id = u.id INNER JOIN reviews_imgs ri ON r.id = ri.review_id');
        return $stmt->fetchAll();
    }

    public function getReviewByProductId(int $productId)
    {
        //TODO вот тут правильный inner join, переделать на его основе
        $stmt = $this->pdo->prepare('SELECT r.id, text, created_at,u.login,u.image as user_image FROM users u INNER JOIN reviews r ON r.author_id = u.id WHERE r.product_id = :id');
        $stmt->execute([':id'=>$productId]);
        return $stmt->fetchAll();

    }



    public function searchRecord(int $userId)
    {
        $stmt = $this->pdo->prepare('SELECT id, text, created_at FROM reviews WHERE author_id = :author_id');
        $stmt->execute([':author_id'=>$userId]);
        return $stmt->fetchAll();
    }

    public function insertRecord(int $authorId, int $productId, string $text,array $imgs)
    {
        $stmt = $this->pdo->prepare('INSERT INTO reviews (author_id, product_id, text) VALUES (:author_id,:product_id,:text)');
        $stmt->execute([
            ':author_id'=>$authorId,
            ":product_id"=>$productId,
            ":text"=>$text,
        ]);

        if($imgs){
            $this->insertReviewsImgs($this->pdo->lastInsertId(),$imgs);
        }


    }

    public function insertReviewsImgs(int $reviewId, array $imgs)
    {
        foreach($imgs as $img){
            $stmt=$this->pdo->prepare("INSERT INTO reviews_imgs (review_id, image) VALUES (:review_id, :image)");
            $stmt->execute([
                ':review_id'=>$reviewId,
                ':image'=>$img
            ]);
        }
    }

}