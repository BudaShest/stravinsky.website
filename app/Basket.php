<?php


namespace app;
use PDO;
use app\Product;

//Данный класс реализует логику пользовательской коризны
class Basket
{
    private Product $productWorker;
    private array $basketRes = [];

    public function __construct(Product $dataProduct)
    {
        $this->productWorker = $dataProduct;
    }

    public function basketCreate(array $basket)
    {

        foreach ($basket as $prodId=>$quantity) {
            $this->basketRes['products'][] = $this->productWorker->getOneProduct($prodId);
            $this->basketRes['quantity'][] = $quantity;
        }
    }

    public function getBasket()
    {
        return $this->basketRes;
    }


//Это перенесено на клиентскую сторону
//    public function getSumPrice(){
//        $sum = 0;
//        if($this->basketRes){
//            foreach ($this->basketRes['products'] as $key => $product){
//                $sum += $product->price * $this->basketRes['quantity'][$key];
//            }
//        }
//        return $sum;
//    }

    public function clearBasket(){
        if(isset($_SESSION['basket'])){
            unset($_SESSION['basket']);
        }
        header('Location: /');
    }



}