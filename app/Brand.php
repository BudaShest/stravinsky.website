<?php


namespace app;
use PDO;

//Данный класс описывает бренды-производители
class Brand
{
    private string $tableName = 'brands';
    private PDO $pdo;
    use DBLogger;



    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAllRecords($limit=null):array
    {
        if($limit === null){
            $stmt=$this->pdo->query('SELECT brands.id as id,brands.name as name, brands.image as image, brands.color as color,categories.name as cat_name FROM brands, categories,brands_in_categories
                WHERE brands.id = brands_in_categories.brand_id AND categories.id = brands_in_categories.category_id');
        }else{
            if(is_int($limit) && $limit > 0){
                $stmt = $this->pdo->prepare('SELECT DISTINCT * FROM brands ORDER BY RAND() LIMIT :limit');
                $stmt->bindValue(':limit',$limit, PDO::PARAM_INT); //Т.к execute обрамляет значения каввычками, limit не работает без int, надо байндить value
                $stmt->execute();
            }else{
                return [];
            }
        }
        return $stmt->fetchAll();
    }

    public function insertRecord(string $name, int $categoryId, string $image, string $color):void
    {
        $stmt = $this->pdo->prepare('INSERT INTO brands (name, image, color) VALUES (:name, :image, :color)');
        $stmt->execute([
            ':name'=>$name,
            ":image"=>$image,
            ":color"=>$color
        ]);
        $this->insertBrandsCategory($categoryId);

    }



    public function insertBrandsCategory(int $categoryId):void
    {
        $lastId = $this->getLastId('brands');
        $stmt = $this->pdo->prepare("INSERT INTO brands_in_categories (brand_id, category_id) VALUES (:brand_id, :category_id)");
        $stmt->execute([
            "brand_id"=>$lastId,
            "category_id"=>$categoryId
        ]);
    }

    public function updateBrandsCategory(int $brandId, int $categoryId)
    {
        $stmt = $this->pdo->prepare("UPDATE brands_in_categories SET category_id = :category_id WHERE brand_id = :brand_id");
        $stmt->execute([
            ':category_id'=>$categoryId,
            ':brand_id'=>$brandId
        ]);
    }

    public function searchRecord(int $brandId, bool $assoc=false)
    {
        $stmt = $this->pdo->prepare('SELECT b.id,b.name,b.image,b.color,bic.brand_id,bic.category_id, c.name as cat_name FROM brands b INNER JOIN brands_in_categories bic ON b.id = bic.brand_id INNER JOIN categories c on bic.category_id = c.id WHERE b.id = :brand_id');
        $stmt->execute([':brand_id'=>$brandId]);
        if($assoc){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $stmt->fetch();
    }

    public function getBrandsByCategory(int $categoryId)
    {
        $stmt = $this->pdo->prepare('SELECT b.id,b.name,b.image,b.color,bic.brand_id,bic.category_id, c.name as cat_name FROM brands b INNER JOIN brands_in_categories bic ON b.id = bic.brand_id INNER JOIN categories c on bic.category_id = c.id WHERE bic.category_id = :category_id');
        $stmt->execute([':category_id'=>$categoryId]);
        return $stmt->fetchAll();
    }

    public function updateBrand(int $brandId, string $name, int $categoryId, string $image, string $color){
        $stmt = $this->pdo->prepare('UPDATE brands SET name = :name,image = :image, color = :color WHERE id=:brand_id');
        $stmt->execute([
            ':name'=>$name,
            ':image'=>$image,
            ':color'=>$color,
            ':brand_id'=>$brandId
        ]);

        $this->updateBrandsCategory($brandId,$categoryId);

    }


}