<?php


namespace app;
use PDO;

trait DBLogger
{


    public abstract function insertRecord();

    public abstract function getAllRecords();

    public abstract function searchRecord();

    public function getLastId(string $tableName):int //TODO pdo сам может возвращать
    {
        $stmt = $this->pdo->query("SELECT id FROM {$tableName} ORDER BY id DESC LIMIT 1");
        return (int)($stmt->fetch()->id);
    }

    public function getAllNames():array
    {
        if($this->tableName=="users"){
            $stmt = $this->pdo->query("SELECT login FROM users");
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        $stmt = $this->pdo->query("SELECT name FROM {$this->tableName}");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function deleteOneRecord($id):void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id=:id");
        $stmt->execute([
            ':id'=>$id
        ]);
    }

    //TODO тестинг
    public function getImageName(int $id)
    {
        if($this->tableName == "products"){
            $stmt = $this->pdo->prepare("SELECT image FROM products_imgs WHERE product_id=:id");
            $stmt->execute([
                ':id'=>$id
            ]);

            return $stmt->fetchAll(PDO::FETCH_COLUMN);

        }else if($this->tableName=="reviews"){
            $stmt = $this->pdo->prepare('SELECT image FROM reviews_imgs WHERE review_id=:id');
            $stmt->execute([
               ':id'=>$id
            ]);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);

        }else{
            $stmt = $this->pdo->prepare("SELECT image FROM {$this->tableName} WHERE id=:id");
            $stmt->execute([
                ':id'=>$id
            ]);

            return $stmt->fetch()->image??"";
        }

    }

}