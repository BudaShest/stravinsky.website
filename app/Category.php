<?php


namespace app;
use PDO;


class Category
{
    private string $tableName = 'categories';
    use DBLogger;
    private PDO $pdo;

    public function getSubCategories():array
    {
        $stmt = $this->pdo->query("SELECT * FROM subcategories");
        return $stmt->fetchAll();
    }

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function searchRecord()
    {
        // TODO: Implement searchRecord() method.
    }

    public function insertRecord(string $name,int $subcategory_id, string $color):void
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (name, sub_category_id, color) VALUES (:name, :subcategory_id, :color)');
        $stmt->execute([
           ":name"=> $name,
            ":subcategory_id"=>$subcategory_id,
            ":color"=>$color,
        ]);

    }

    public function getAllRecords():array
    {
        $stmt = $this->pdo->query("SELECT categories.id as id,categories.name as name, color, subcategories.name as sub_name FROM categories INNER JOIN subcategories ON categories.sub_category_id = subcategories.id");
        return $stmt->fetchAll();
    }

    public function getCategoriesBySuper(int $superId):array
    {
        $stmt = $this->pdo->prepare('SELECT c.id,c.name,c.sub_category_id,c.color,s.name as sub_name FROM categories c INNER JOIN subcategories s on c.sub_category_id = s.id WHERE c.sub_category_id = :super_cat_id');
        $stmt->execute([':super_cat_id'=>$superId]);
        return $stmt->fetchAll();
    }

    public function getCategoriesByBrand(int $brandId)
    {
        $stmt = $this->pdo->prepare("SELECT c.id,c.name, c.sub_category_id,c.color,bic.brand_id FROM categories c INNER JOIN brands_in_categories bic on c.id = bic.category_id WHERE bic.brand_id = :brand_id");
        $stmt->execute([':brand_id'=>$brandId]);
        return $stmt->fetchAll();
    }
}