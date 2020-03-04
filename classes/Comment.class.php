<?php
require_once 'core/init.php';

class Comment{
    private static $_pdo;

    public static function init(){
        self::$_pdo = Connect::getInstance();
    }

    public static function getAll(){
        $q = self::$_pdo->query("SELECT * FROM fruit.comments");
        $postArr = $q->fetchAll(PDO::FETCH_ASSOC);
        return $postArr;
    }

    public static function getDisapprovedComments()
    {
        $q = self::$_pdo->query("SELECT * FROM fruit.comments WHERE active=0");
        $postArr = $q->fetchAll(PDO::FETCH_ASSOC);
        return $postArr;
    }

    public static function getApprovedComments()
    {
        $q = self::$_pdo->query("SELECT * FROM fruit.comments WHERE active=1");
        $postArr = $q->fetchAll(PDO::FETCH_ASSOC);
        return $postArr;
    }

    public static function approveComment($id){
        $q = self::$_pdo->prepare("UPDATE fruit.comments SET active=1  WHERE id =?");
        $q->bindValue(1,$id);
        $q->execute();
    }

}
Comment::init();



?>