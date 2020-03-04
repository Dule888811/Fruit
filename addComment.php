<?php
require 'core/init.php';


   // var_dump($_SESSION['user_id']);
    if(isset($_POST['commentOfUser']) && !empty(trim($_POST['commentOfUser'])))
    {
        $comment = $_POST['commentOfUser'];
        $user_id = (int)$_SESSION['user_id'];
        var_dump($user_id);
        $query = $pdo->prepare("INSERT INTO fruit.comments (comment,user_id) VALUES (?,$user_id)");
        $query->bindParam(1, $comment);
        $query->execute();
        header("Location:index.php");
    }



?>