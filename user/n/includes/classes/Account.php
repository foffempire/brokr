<?php 
	// require_once "includes/classes/Helper.php";

	class Account {
		
		private $kon;
		private $error;


		public function __construct($kon, $error = ""){
			$this->kon = $kon;
			$this->error = $error;
		}


		// **************************** Signup methods *************************************
		public function signup($email, $pw, $pw2){
			if($this->validateEmail($email) && $this->validatePassword($pw, $pw2)){
				
				$date = date(" M d, Y : h:i:s");
				$pw = md5($pw);
				$prc = Helper::randomString(10);

				$insert = $this->kon->prepare("INSERT INTO users (email, password, reg_date, pw_reset_code) VALUES (:email, :pw, :dt, :prc )");
				$insert->bindParam(":email", $email);
				$insert->bindParam(":pw", $pw);
				$insert->bindParam(":dt", $date);
				$insert->bindParam(":prc", $prc);

				return $insert->execute();
				

				$message = "click the link to confirm your email";
				$message .= "https://".$_SERVER['HTTP_HOST']."/confirm_email?pre=$prc&email=$email";

				//mail($email, "Account Confirmation", $message);


			}
		}

		private function validateFirstName($fn){
			if(strlen($fn) < 2 || strlen($fn) > 20){
				$this->error = "First name must be between 2 and 20 characters";
				return false;
			}else{
				return true;
			}
		}

		private function validateLastName($ln){
			if(strlen($ln) < 2 || strlen($ln) > 20){
				$this->error = "Last name must be between 2 and 20 characters";
				return false;
			}else{
				return true;
			}
		}


		private function validateEmail($email){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this->error = "Enter a valid email";
				return false;
			}elseif ($this->email_exist($email)) {
				$this->error = "Email exist in our database, use another email";
				return false;
			}else{
				return true;
			}
		}


		private function validatePassword($pw, $pw2){
			if(strlen($pw) < 6){
				$this->error = "Password must exceed 6 characters";
				return false;
			}elseif($pw !== $pw2){
				$this->error = "Password doesn't match";
				return false;
			}else{
				return true;
			}
		}

		
		public function email_exist($email){
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email =:em ");
			$stmt->bindParam(":em", $email);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				return true;
			}
		}



		// ***************************** Login methods ***********************************

		public function login($email, $pw){

			if($this->validateLogin($email, $pw)){
				// $pw = md5($pw);

				$stmt = $this->kon->prepare("SELECT * FROM admin_user WHERE email = :em AND password = :pw ");
				$stmt->bindParam(":em", $email);
				$stmt->bindParam(":pw", $pw);
				$stmt->execute();

				if($stmt->rowCount() == 1){
					return true;					
				}else{
					$this->error = "Invalid login details";
					return false;
				}
			}
			
		}
		

		private function validateLogin($email, $pw){
			if(empty($email) || empty($pw)){
				$this->error = "All fields are required";
				return false;
			}else{
				return true;
			}
		}


		private function isActivated($email){
			$val = 1;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND is_verified = :val ");
			$stmt->bindParam(":em", $email);
			$stmt->bindParam(":val", $val);
			$stmt->execute();

			if($stmt->rowCount() == 1){
				return true;
			}else{
				$this->error = "Check your email to activate your account";
				return false;
			}

		}




		// ******************** change password methods ********************

		public  function changePassword($email, $pw, $pw2){
			if ($this->validatePassword($pw, $pw2)) {
				
				$pw = md5($pw);
				$updt = $this->kon->prepare("UPDATE users SET password = :pw WHERE email = :email");				
				$updt->bindParam(":pw", $pw);
				$updt->bindParam(":email", $email);

				return $updt->execute();
			}

		}

		public function validateOldPassword($email, $op){
			$op = md5($op);
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND password = :pw ");			
			$stmt->bindParam(":em", $email);
			$stmt->bindParam(":pw", $op);
			$stmt->execute();

			if ($stmt->rowCount() === 1) {
				return true;
			}else{
				$this->error = "Enter your correct password";
				return false;
			}
		}



		// ******************** get error method ******************
		public function getError(){
			return "<div class='error-msg'> $this->error </div>";
		}

	}



 ?>