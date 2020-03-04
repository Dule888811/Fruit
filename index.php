<?php
require_once 'core/init.php';
?>
<head>
    <title>Fruit</title>
    <link rel='stylesheet' type="text/css" href="css/style.css">
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>
<?php
if (isset($_SESSION['user_id'])) {
    ?> <a href="logout.php">Logout</a>;
    <?php
} else {
    ?>
    <a href="loginW.php">Login</a></br>
    <a href="registerW.php">Register here</a>
    <?php
}
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1){
        echo "<a href=\"insert.php\">Insert product</a>";
    }

$url = $_SERVER['REQUEST_URI'];
$url = explode('?',$url);
$url = explode('=',$url[1]);
$page = (int)$url[1];
$results_per_page = 9;
if($page == 0){
    $page = 1;
}
$starting_limit_number = ($page - 1) * $results_per_page;
$number_of_rows = Product::getNumberOfProducts();
$number_of_pages = ceil($number_of_rows/$results_per_page);
$results = Product::getProductForPage($starting_limit_number,$results_per_page);
echo "<div class=\"grids\">";
echo ' <ul class="grid-9">';
foreach($results as $result) {
    $post = Product::get($result['id']);
    echo $post->render();
}
echo "</ul>";
echo "</div>";
$results = Comment::getApprovedComments();
if(isset($results) && $results > 0){
    echo "<ul>";
    foreach($results as $result){
        echo "<li>" . $result['comment'] . "</li>";
    }
    echo "</ul>";
}
?>
<?php if(isset( $_SESSION['name']) && $_SESSION['user_role'] != 1) {
    ?>
    <form action="addComment.php" method="POST">
        <label for="fname">Name:</label>
        <input type="text" id="fname" name="fname" value=<?php echo $_SESSION['name'] ?> readonly><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value=<?php echo $_SESSION['email'] ?> readonly><br><br>
        <label for="commentOfUser">Your comment about products or company:</label><br>
        <textarea id="commentOfUser" name="commentOfUser" rows="4" cols="50">
         </textarea><br><br>
        <input type="submit" value="addYourComment"/>
    </form>
    <?php
}else if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1){
   echo "Welcome" . " " . $_SESSION['name'] . "<br><br>";
    $results = Comment::getDisapprovedComments();
    if(isset($results) && $results > 0){
        echo "<ul>";
        foreach($results as $result){
           echo "<li>" . $result['comment'] . "</li><a href='approveComent.php?id=" . $result['id'] ."' >Approve</a>'";
        }
        echo "</ul>";
    }
}else{
    echo "You must log in to comment on products and company<br><br>";
}


for($page=1;$page <=$number_of_pages;$page++ )
{
    echo '<a class="pagination" href="index.php?page=' . $page . '">' . $page . '</a>';
}

?>