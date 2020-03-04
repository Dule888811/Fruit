<form action="#" name="insert-product" method="POST" enctype="multipart/form-data">
    <label for="product_title">product title: <br/>
        <input type="text" name="product_title" id="product_title"></label><br/>
    <label for="product_description">product description: <br/>
        <input type="text" name="product_description" id="product_description"></label><br/>
    <label class = "imgfile">Upload Picture:</label>
    <input type = "file" name = "imgfile">
    <input type="submit" name="insert"  value="Insert"><br/>
</form>
<a href="index.php">Back to main page</a>
<?php
require 'core/init.php';
if(isset($_POST['insert'])){
    if(isset($_POST['product_title']) && isset($_POST['product_description'])  && isset($_FILES['imgfile'])){
        if(!empty($_POST['product_title']) && !empty($_POST['product_description']) && !empty($_FILES['imgfile']) ){
            $product_title = trim($_POST['product_title']);
            $product_description = trim($_POST['product_description']);
            if(isset($_FILES['imgfile']) && $_FILES['imgfile']['size'] > 0 && $_FILES['imgfile']['size'] < 500000){
                if($_FILES['imgfile']['type'] == 'image/jpeg' || $_FILES['imgfile']['type'] == 'image/png') {
                    $listaExt = array('png','jpg','jpeg');
                    $ext = $_FILES['imgfile']['name'];
                    $ext = explode(".", $ext);
                    $ext = array_pop($ext);
                    if(in_array($ext,$listaExt)) {
                        $img = file_get_contents($_FILES['imgfile']['tmp_name']);
                        $img = base64_encode($img);
                        $query = $pdo->prepare("INSERT INTO fruit.products (product_title,short_product_description,product_image) VALUES (?,?,?)");
                        $query->bindParam(1, $product_title);
                        $query->bindParam(2, $product_description);
                        $query->bindParam(3, $img);
                        $query->execute();
                    }else{
                        echo "Extension format not supported";
                    }
                }else{
                    echo "Format not supported";
                }
            }
        }else {
            echo "You must not send blank fields.";
        }
    }else {
        echo "You must fill in all the fields.";
    }
}
?>