<?php
require 'core/init.php';
if(isset($_GET['id']))
{
    $id = (int)$_GET['id'];
    Comment::approveComment($id);
    header("Location:index.php");
}