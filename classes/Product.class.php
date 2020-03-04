<?php
require_once 'core/init.php';

class Product {
    private static $_pdo;
    public static function init(){
        self::$_pdo = Connect::getInstance();
    }

    public  function render()
    {
        $render = '<li class="productList">';
        $render .= "<h2>Product title:" . $this->product_title . "</h2>";
        $render .= "<p>Product description:" . $this->short_product_description . "</p>";
        $render .="<img width=\"60%\" height=\"60%\" src ='data:image/jpeg; base64," . $this->product_image . "'>";
        $render .="</li>";
        return $render;
    }

    public static function getAll(){
        $q = self::$_pdo->query("SELECT * FROM fruit.products");
        $postArr = $q->fetchAll(PDO::FETCH_ASSOC);
        return $postArr;
    }

    public static function get($id){
        $q = self::$_pdo->prepare("SELECT * FROM fruit.products  WHERE id =?");
        $q->bindValue(1,$id);
        $q->execute();
        $post = $q->fetchObject('Product');
        return $post;
    }

    public static function getNumberOfProducts()
    {
        $result = self::$_pdo->query("SELECT COUNT(id) AS NumberOfProducts FROM fruit.products");
         $result->execute();
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }

    public static function getProductForPage($starting_limit_number,$results_per_page)
    {
        $q = self::$_pdo->prepare("SELECT * FROM fruit.products  LIMIT $starting_limit_number,$results_per_page");
      //  $q->bindValue(1,(int)$starting_limit_number);
       // $q->bindValue(2,(int)$results_per_page);
        $q->execute();
        $post = $q->fetchAll(PDO::FETCH_ASSOC);
        return $post;
    }

}
Product::init();
?>