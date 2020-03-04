
<?php

include_once 'core/init.php';
$errors = array();
    $required_fields = array('password','user_name','email');
    foreach($required_fields as $field){
        if(!isset($_POST[$field]) || empty(trim($_POST[$field]))){
            switch($field){
                case 'password': $f = 'password'; break;
                case 'user_name': $f = 'Name'; break;
                case 'email': $f = 'E-mail'; break;
            }
            $errors[] = 'Field <b>' . $f . '</b> must be insert.';
        }else{
            $$field = trim($_POST[$field]);
        }
    }
    if(isset($_POST['email'])){
        if(User::emial_exists($_POST['email'])) $errors[] = 'There is  user with this email address.';
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter valid Email address.';
    }
    if(empty($errors))
    {
        User::register_new_user($_POST['password'], $_POST['user_name'], $_POST['email']);
            header('Location: index.php');
   }else{
        ?>
    <h1>Registration failed!</h1>
    <ul><li><?php echo implode('</li><li>', $errors) ?></li></ul>
    <?php }
    ?>