<?php


namespace app;
use PDO;


class Application
{
    private string $tableName = "application";
    private PDO $pdo;
    use DBLogger;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function insertRecord(int $userId, array $products,int $sumPrice):void
    {
        $stmt = $this->pdo->prepare('INSERT INTO application (user_id, sum_price) VALUES (:user_id,:sum_price)');
        $stmt->execute([
            ':user_id'=>$userId,
            ':sum_price'=>$sumPrice
        ]);
        $this->insertProductsInApplication($this->pdo->lastInsertId(),$products);
    }

    public function insertProductsInApplication(int $applicationId, array $products):void
    {
        foreach ($products as $prodId=>$quantity){
            $stmt = $this->pdo->prepare('INSERT INTO products_in_application (application_id, product_id, quantity) VALUES (:application_id, :product_id, :quantity)');
            $stmt->execute([
                ':application_id'=>$applicationId,
                ':product_id'=>$prodId,
                ':quantity'=>$quantity
            ]);
        }
    }

    public function searchRecord($userId)
    {
        $stmt = $this->pdo->prepare('SELECT a.id, user_id, created_at, status_id, sum_price, name FROM application a INNER JOIN statuses s on a.status_id = s.id WHERE user_id=:user_id');
        $stmt->execute([':user_id'=>$userId]);
        return $stmt->fetchAll();
    }

    public function getAllRecords()
    {
        $stmt = $this->pdo->query('SELECT a.id, user_id,u.login, created_at, status_id, sum_price, name FROM application a INNER JOIN statuses s on a.status_id = s.id INNER JOIN users u on a.user_id = u.id');
        return $stmt->fetchAll();
    }

    public function getStatuses()
    {
        $stmt = $this->pdo->query('SELECT * FROM statuses');
        return $stmt->fetchAll();
    }

    public function changeStatus($applicationId, $statusId)
    {
        $stmt = $this->pdo->prepare('UPDATE application SET status_id = :status_id WHERE id=:id');
        $stmt->execute([
            ':id'=>$applicationId,
            ':status_id'=>$statusId
        ]);

    }

    public function getApplicationByStatusId(int $statusId)
    {
        $stmt = $this->pdo->prepare('SELECT a.id, user_id,u.login, created_at, status_id, sum_price, name FROM application a INNER JOIN statuses s on a.status_id = s.id INNER JOIN users u on a.user_id = u.id WHERE a.status_id = :status_id');
        $stmt->execute(['status_id'=>$statusId]);
        return $stmt->fetchAll();
    }
}