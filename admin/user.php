<?php 

require_once'../core/init.php';
	
class User{
	private $db;
	public function __construct()
	{
		$this->db=new Database();
	}

	public function userRegistration($data){
		$name     =$data['name'];
		$username  =$data['username'];
		$email  =$data['email'];
		$password= $data['pass']; 


		if ($name == "" OR $username == "" OR $email == "" OR $password == "") {
			$msg="<div class='alert alert-danger' ><strong>Error!</strong> Field must not be empty ! </div>";
			return $msg;
		}
	if (strlen($username) < 3) {
		$msg="<div class='alert alert-danger' ><strong>Error!</strong> Username is too short! [4 word at lest!] </div>";
			return $msg;
	}
		elseif (!preg_match("/^[a-zA-Z ]*$/", $username)) {
			$msg="<div class='alert alert-danger' ><strong>Error!</strong> The Username is not valid ! </div>";
			return $msg;

		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg="<div class='alert alert-danger' ><strong>Error!</strong> The email address is mot valid! </div>";
			return $msg;


		}
		else
		{
		$insert="insert into admin (name,username,email,password) values ('$name','$username','$email','$password')";
		$create=$this->db->admininsert($insert);
		 header('Location:registration.php');
			}
		

			
		}
	
	
	}
?>