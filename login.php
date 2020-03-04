
<?php
require 'core/init.php';
if(isset($_POST['email'], $_POST['password'])){
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$password = md5($password);
	if(!empty($email) && !empty($password)){
		$stmtUserCheck = $pdo->prepare("SELECT * FROM fruit.users WHERE email=? AND password=?");
		$stmtUserCheck->bindValue(1,$email);
		$stmtUserCheck->bindValue(2,$password);
		$stmtUserCheck->execute();

	//	var_dump($stmtUserCheck->rowCount());
		if($stmtUserCheck->rowCount() == 0){
			echo "unknown user";
		}else {
			$user = $stmtUserCheck->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($user);
			$_SESSION['user_id'] = $user[0]['id'];
			$_SESSION['name'] = $user[0]['name'];
			$_SESSION['user_role'] = $user[0]['user_role'];
			$_SESSION['email'] = $user[0]['email'];
			header("Location:index.php");
			//var_dump($_SESSION['email']);
		}
	}else {
	    echo "Morate uneti potrebne podatke";
    }
}
?>