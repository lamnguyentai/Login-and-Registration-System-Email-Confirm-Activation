<?php include "db.php"; ?>
<?php



/*******************Helper Functions************************/


function clean($string){

	return htmlentities($string);

} 



function redirect($location){

	return header("Location: {$location}");

}



function set_message($message){
	if(!empty($message)){

		$_SESSION['message'] = $message;

	}else{

		$message = "";

	}
}



function display_message(){

	if(isset($_SESSION['message'])){

		echo $_SESSION['message'];

		unset($_SESSION['message']);
	}

}



function token_generator(){

	$token = $_SESSION['token']= md5(uniqid(mt_rand(), true));

	return $token;

}


function validation_errors($error_message){
	echo '
		<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>Warning!</strong> '.$error_message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
		</div>

	';

}


function email_exists($email){
	$sql = "SELECT id FROM users WHERE email = '$email'";

	$result = query($sql);

	if(row_count($result) == 1){
		return true;
	}else{
		 return false;
	}
}


function username_exists($username){
	$sql = "SELECT id FROM users WHERE username = '$username'";

	$result = query($sql);

	if(row_count($result) == 1){
		return true;
	}else{
		return false;
	}
}



function send_email($email, $subject, $msg, $headers){
	


	return mail($email, $subject, $msg, $headers);
}




/**************** Register User Functions*************************/

function validaton_user_registration(){

		$min = 3;
		$max = 20;
		$errors = [];


	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$first_name			=    clean($_POST['first_name']);
		$last_name			=    clean($_POST['last_name']);
		$username			=    clean($_POST['username']);
		$email				=    clean($_POST['email']);
		$password           =    clean($_POST['password']);
		$confirm_password   =    clean($_POST['confirm_password']);


		if(strlen($first_name) < $min){
			$errors[] =  "Your first name cannot be less than {$min} characters";
		}

		if(strlen($first_name) > $max){
			$errors[] =  "Your first name cannot be more than {$max} characters";
		}

		if(strlen($last_name) < $min){
			$errors[] =  "Your last name cannot be less than {$min} characters";
		}

		if(strlen($last_name) > $max){
			$errors[] =  "Your last name cannot be more than {$max} characters";
		}

		if(strlen($username) < $min){
			$errors[] =  "Your username cannot be less than {$min} characters";
		}

		if(strlen($username) > $max){
			$errors[] =  "Your username cannot be more than {$max} characters";
		}


		if(username_exists($username)){
			$errors[] = "Sorry that usename is already is taken";
		}

		if(email_exists($email)){
			$errors[] = "Sorry that usename is already registerd";
		}

		if(strlen($email) < $min){
			$errors[] =  "Your email cannot be less than {$min} characters";
		}


		if($password !== $confirm_password){
			$errors[] = "Your password fields do not match";
		}


		if(!empty($errors)){
			foreach ($errors as $error) {
				validation_errors($error);
			}
		}else{

		 		if(register_user($first_name, $last_name, $username, $email, $password)){
				set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");

		 			redirect("index.php");
		 			
			} else {

				set_message("<p class='bg-danger text-center'>Sorry that we could not register the user</p>");

		 			redirect("index.php");

			}

}
	}
}


function register_user($first_name, $last_name, $username, $email, $password){

	$first_name = escape($first_name);
	$last_name  = escape($last_name);
	$username  = escape($username);
	$email      = escape($email);
	$password   = escape($password);

if(email_exists($email)){

		return false;

} else if (username_exists($username)){

		return false;

} else {

		$password = md5($password);

		$validation_code = md5($username . microtime());
 		
 		$sql = "INSERT INTO users(first_name, last_name, username , email, password, validation_code , active)";
 		$sql .= " VALUES('$first_name','$last_name', '$username', '$email', '$password', '$validation_code' , 0)";

 		$result = query($sql);
 		confirm($result);


 		$subject = "Activate Account";
 		$msg = "Please click the link below to activate your Account http://nguyentailam.tonkotsu.jp/login/activate.php?email=$email&code=$validation_code";


 			$headers = "From: info@nguyentailam.tonkotsu.jp";


 			send_email($email, $subject, $msg, $headers);

}

return true;

}


/**************** Activate User Functions*************************/


function activate_user(){

	if($_SERVER['REQUEST_METHOD'] == "GET"){

		if(isset($_GET['email'])){

			$email = clean($_GET['email']);

			$validation_code = clean($_GET['code']);

			$sql = "SELECT id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' ";

			$result = query($sql);
			confirm($result);

		
			if(row_count($result) == 1){

				$sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";

				$result2 = query($sql2);
				confirm($result2);

			set_message("<p class='bg-success'> Your account has been activated please log in</>");

			redirect("login.php");

		} else {

			set_message("<p class='bg-danger'>Sorry Your account could not be activated<p/>");

			redirect("login.php");

		}
	}
}

}



/**************** Validate User Login Functions*************************/

function validate_user_login(){

	$errors = [];

	$min = 3;
	$max = 20;

	if($_SERVER['REQUEST_METHOD'] == "POST"){

	$email			=    clean($_POST['email']);
	$password       =    clean($_POST['password']);
	$remember       =    isset($_POST['remember']);


	if(empty($email)){

		$errors[] = "Email field cannot be empty";

	}

	if(empty($password)){

		$errors[] = "password field cannot be empty";

	}





	if(!empty($errors)){
			foreach ($errors as $error) {

				validation_errors($error);
			}


		} else {

			if(login_user($email, $password, $remember)){

				redirect("admin.php");

			} else {

				validation_errors("Username or password is not correct!");

			}

}
	}

}




/**************** User Login Functions*************************/

function login_user($email, $password, $remember){

	$sql = "SELECT * FROM users WHERE email = '".escape($email)."' AND active = 1";
	$result = query($sql);
	confirm($result);

	if(row_count($result) == 1){
		$row = fetch_array($result);
		$db_password = $row['password'];

		if(md5($password) === $db_password){
			if($remember == "on"){

				setcookie('email', $email, time() + 86400);
			}




			$_SESSION['email'] = $email;
			return true;
		} else {
			return false;
		}

	} else {

		return false;


}
}

/**************** Logged In Functions*************************/

function logged_in(){

if(isset($_SESSION['email']) || isset($_COOKIE['email'])){

	return true;

} else {

	return false;

}
}



/**************** Recover Password Functions*************************/


function recover_password(){

	if(isset($_POST['recover_submit']) && !empty($_POST['email'])){

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']){

		$email  = escape($_POST['email']);


		if(email_exists($_POST['email'])){

		$validation_code = md5($email . microtime());

		setcookie('temp_access_code', $validation_code, time() + 900);

		$sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
		$result = query($sql);
		confirm($result);

		$subject = "Please reset your password";
		$message = " Here is your password reset code: {$validation_code}
			Click here to reset your password http://nguyentailam.tonkotsu.jp/login/code.php?email=$email&code=$validation_code ";
		$headers = "From: info@nguyentailam.tonkotsu.jp";

		send_email($email, $subject, $message, $headers);
				
		set_message("<p class='bg-success text-center'>Please check spam folder for a password reset code</p>");
		redirect("index.php");
		
		} else {

		set_message("<p class='bg-success text-center'>Please check spam folder for a password reset code</p>");
		redirect("index.php");

		}
	}

	
	} else if(isset($_POST['cancel_submit'])){
			redirect("login.php");

	} else {


	}



}



/**************** Code Validation Functions*************************/

function validate_code(){

	if(isset($_COOKIE['temp_access_code'])){

		if($_SERVER['REQUEST_METHOD'] == "POST"){

			if(!isset($_GET['email']) && !isset($_GET['code'])){

				redirect("index.php");


			}else if(empty($_GET['email']) || empty($_GET['code'])){

				redirect("index.php");

			} else {

				if(isset($_POST['code'])){
					$email = clean($_GET['email']);
					$validation_code = clean($_POST['code']);

					$sql = "SELECT id FROM users WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."' ";
					$result = query($sql);
					if(row_count($result) == 1){

						redirect("reset.php?email=$email&code=$validation_code");

					} else {

						echo validation_errors("Sorry wrong validation code");
					}

					}
				}

		}



	} else {

		set_message("<p class='bg-danger text-center'>Sorry your validation cookie was expired</p>");

		redirect("recover.php");
	}
}


/**************** Password Reset Functions *************************/

function password_reset(){
	if(isset($_COOKIE['temp_access_code'])){

		if(isset($_GET['email']) && isset($_GET['code'])){

			if(isset($_SESSION['token']) &&isset($_POST['token'])){

				if($_POST['token'] === $_SESSION['token']){

				if($_POST['password'] === $_POST['confirm_password']){

				$updated_password = md5($_POST['password']);
 	
				$sql = "UPDATE users SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
				query($sql);
				set_message("<p class='bg-success text-center'>Your password has been updated, please log in</p>");
				redirect("login.php");
			}
		}

	}

}

		} else {

		set_message("<p class='bg-danger text-center'>Sorry your time has espired</p>");
		redirect("recover.php");

	}
}
?>