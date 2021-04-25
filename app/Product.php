<?php


namespace app;
use PDO;


class Product
{
    private string $tableName = 'products';
    use DBLogger;
    private PDO $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAllRecords():array
    {
        $stmt = $this->pdo->query('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name as cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id GROUP BY p.id');
        return $stmt->fetchAll();
    }

    public function getProductsByBrand(int $brandId):array
    {

        $stmt = $this->pdo->prepare('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id WHERE p.brand_id = :brand_id GROUP BY p.id');
        $stmt->execute([
           ':brand_id'=>$brandId,
        ]);
        return $stmt->fetchAll();
    }


    public function getProductsByCategory(int $categoryId):array
    {
        $stmt = $this->pdo->prepare('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id WHERE p.category_id = :category_id GROUP BY p.id');
        $stmt->execute([
            ':category_id'=>$categoryId,
        ]);
        return $stmt->fetchAll();
    }

    public function getProductsByBrandAndCategory(int $categoryId, int $brandId)
    {
        $stmt = $this->pdo->prepare('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id WHERE p.brand_id = :brand_id AND p.category_id = :category_id GROUP BY p.id');
        $stmt->execute([
            ':category_id'=>$categoryId,
            ':brand_id'=>$brandId,
        ]);
        return $stmt->fetchAll();
    }

    public function insertRecord($brand_id, $category_id, $name, $feature, $description, $price, $video, $imgs)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (brand_id, category_id, name, feature, description, price, video) 
                                            VALUES (:brand_id, :category_id, :name, :feature, :description, :price, :video)');

        $stmt->execute([
            ":brand_id"=>$brand_id,
            ":category_id"=>$category_id,
            ":name"=>$name,
            ":feature"=>$feature,
            ":description"=>$description,
            ":price"=>$price,
            ":video"=>$video

        ]);

        if($imgs){
            $this->insertProductImgs($this->getLastId('products'), $imgs);
        }
    }

    public function insertProductImgs(int $productId, array $imgs):void
    {
        foreach($imgs as $img){
            $stmt=$this->pdo->prepare("INSERT INTO products_imgs (product_id, image) VALUES (:product_id, :image)");
            $stmt->execute([
                ':product_id'=>$productId,
                ':image'=>$img
            ]);
        }
    }



    public function getProductsTop($limit=null):array
    {
        if($limit===null){
            $stmt=$this->pdo->query('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id GROUP BY p.id');
        }else{
            if(is_int($limit) && $limit>0){
                $stmt = $this->pdo->prepare('SELECT pi.image,p.id,p.brand_id,p.name,p.description,p.rating,p.price,c.name AS cat_name FROM products p INNER JOIN categories c ON p.category_id = c.id INNER JOIN products_imgs pi on p.id = pi.product_id GROUP BY p.id LIMIT :limit');
                $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
                $stmt->execute();
            }else{
                return [];
            }
        }
        return $stmt->fetchAll();
    }




    public function getOneProduct(int $productId)
    {
        $stmt = $this->pdo->prepare('SELECT p.id,p.name,p.description,p.feature,p.video,p.rating,p.price,c.name as cat_name FROM products p INNER JOIN categories c on p.category_id = c.id WHERE p.id = :id');
        $stmt->execute(['id'=>$productId]);
        return $stmt->fetch();

    }

    public function searchRecord()
    {
        // TODO: Implement searchRecord() method.
    }



}