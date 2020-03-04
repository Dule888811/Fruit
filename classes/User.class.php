<?php
	require_once 'core/init.php';
	class User {
		private static $_pdo;

		public static function init(){
			self::$_pdo = Connect::getInstance();
		}

		public static function emial_exists($email){
			$query = self::$_pdo->prepare('SELECT id FROM fruit.users WHERE email = :email');
			$query->bindParam(':email', $email);
			$query->execute();
			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
				}
		}

		public static function register_new_user($password, $user_name,  $email)
        {

            $count = self::$_pdo->query("SELECT count(*) FROM fruit.users")->fetchColumn();

            if($count > 0){
                $password = md5($password);
                $query = self::$_pdo->prepare('INSERT INTO fruit.users(password, name, email) VALUES (:password, :name, :email)');
                $query->bindParam(':password', $password);
                $query->bindParam(':name', $user_name);
                $query->bindParam(':email', $email);
                $query->execute();
            }else{
                $password = md5($password);
                $query = self::$_pdo->prepare('INSERT INTO fruit.users(password, name, email,user_role) VALUES (:password, :name, :email,1)');
                $query->bindParam(':password', $password);
                $query->bindParam(':name', $user_name);
                $query->bindParam(':email', $email);
                $query->execute();
            }

        }
	}
	User::init();
	
?>