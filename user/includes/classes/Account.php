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
		public function signup($email, $pw, $pw2,$prc, $ref, $firstname, $lastname, $username, $country, $phone){
			if($this->validateEmail($email) && $this->validateUsername($username) && $this->validatePassword($pw, $pw2)){
				
				$date = date("M d, Y h:i a");
				// $pw = md5($pw);
				

				$insert = $this->kon->prepare("INSERT INTO users (email, password, reg_date, pw_reset_code, unique_id, referrer, firstname, lastname, username, country, phone) VALUES (:email, :pw, :dt, :prc, :unik, :ref, :fn, :ln, :un, :con, :ph )");
				$insert->bindParam(":email", $email);
				$insert->bindParam(":pw", $pw);
				$insert->bindParam(":dt", $date);
				$insert->bindParam(":prc", $prc);				
				$insert->bindParam(":unik", $prc);				
				$insert->bindParam(":ref", $ref);				
				$insert->bindParam(":fn", $firstname);				
				$insert->bindParam(":ln", $lastname);				
				$insert->bindParam(":un", $username);				
				$insert->bindParam(":con", $country);				
				$insert->bindParam(":ph", $phone);				
				return $insert->execute();
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

		private function validateUsername($username){
			if(strlen($username) < 4){
				$this->error = "Username must 4 characters of more";
				return false;
			}elseif($this->usernameExist($username)){
				$this->error = "Username have been used";
				return false;
			}else{
				return true;
			}
		}

		public function usernameExist($username){
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE username =:user ");
			$stmt->bindParam(":user", $username);
			$stmt->execute();

			if($stmt->rowCount() > 0){
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


		function resendCode($email, $prc){
			if(!$this->emailIsVerified($email)){
				$stmt = $this->kon->prepare("UPDATE users SET pw_reset_code = :prc WHERE email =:em ");
				$stmt->bindParam(":prc", $prc);
				$stmt->bindParam(":em", $email);
				return $stmt->execute();
			}
		}



		// ***************************** Login methods ***********************************

		public function login($email, $pw){

			if($this->validateLogin($email, $pw) && $this->isActive($email)){
				// $pw = md5($pw);

				$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND password = :pw ");
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


		private function emailIsVerified($email){
			$val = 1;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND is_verified = :val ");
			$stmt->bindParam(":em", $email);
			$stmt->bindParam(":val", $val);
			$stmt->execute();

			if($stmt->rowCount() == 1){
				return true;
			}else{
				$this->error = "Check your email to activate your account. <a href='resend-code?email=$email'>Resend code</a>";
				return false;
			}
		}

		private function isActive($email){
			$val = 1;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND is_active = :val ");
			$stmt->bindParam(":em", $email);
			$stmt->bindParam(":val", $val);
			$stmt->execute();

			if($stmt->rowCount() == 1){
				return true;
			}else{
				$this->error = "Your Account is Deactivated, please contact: ".Helper::site_email();
				return false;
			}
		}

		// ***************************** confirm email *******************************
		public function confirmEmail($email, $prc){
			$val = 1;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND is_verified = :val ");
			$stmt->bindParam(":val", $val);
			$stmt->bindParam(":em", $email);
			$stmt->execute();
			if ($stmt->rowCount() != 1) {
				$query = $this->kon->prepare("UPDATE users SET is_verified = :val WHERE email = :em AND pw_reset_code = :prc ");
				$query->bindParam(":val", $val);
				$query->bindParam(":em", $email);
				$query->bindParam(":prc", $prc);
				return $query->execute();
			}
		}

		 // ******************** Add to user_value table *********************
		public function addToUserValueTable($email){
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em ");
			$stmt->bindParam(":em", $email);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// add to user_value
			$insert = $this->kon->prepare("INSERT INTO user_value (user_id) VALUES (:user_id)");
			$insert->bindParam(":user_id", $row['user_id']);
			$insert->execute();
		}


		// ******************** password forgot methods *********************

		public function forgotPassword($email){
			if($this->email_exist($email)){
				$reset_code = $this->setResetCode($email);
				if($reset_code){
					return true;
				}else{
					$this->error = "Cannot reset at the moment, try again later";
					return false;
				}
			}else{
				$this->error = "Email does not exist in our database";
				return false;
			}
		}


		private function setResetCode($email){
			$code = rand(100000, 999999);
			$stmt = $this->kon->prepare("UPDATE users SET pw_reset_code = :code WHERE email = :em ");
			$stmt->bindParam(":code", $code);
			$stmt->bindParam(":em", $email);
			return $stmt->execute();
		}


		public function isResetCodeCorrect($email, $code){
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND pw_reset_code = :code ");			
			$stmt->bindParam(":em", $email);
			$stmt->bindParam(":code", $code);
			$stmt->execute();

			if($stmt->rowCount() === 1){
				return true;
			}else{

				$this->error = "Wrong code";

				// set  number of attempts and code expiration
			}
		}


		public function setNewPassword($email, $code, $pw, $pw2){

			if($this->validatePassword($pw, $pw2)){

				// $pw = md5($pw);
				$cd = Helper::randomString(10);
				$stmt = $this->kon->prepare("UPDATE users SET password = :pw, pw_reset_code = :cd WHERE email = :em AND pw_reset_code = :code ");

				$stmt->bindParam(":pw", $pw);
				$stmt->bindParam(":cd", $cd);
				$stmt->bindParam(":em", $email);
				$stmt->bindParam(":code", $code);
				return $stmt->execute();

			}

		}



		// ******************** change password methods ********************

		public  function changePassword($email, $pw, $pw2){
			if ($this->validatePassword($pw, $pw2)) {
				
				// $pw = md5($pw);
				$updt = $this->kon->prepare("UPDATE users SET password = :pw WHERE email = :email");				
				$updt->bindParam(":pw", $pw);
				$updt->bindParam(":email", $email);

				return $updt->execute();
			}

		}

		public function validateOldPassword($email, $op){
			// $op = md5($op);
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
			return $this->error != '' ?  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>$this->error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" : '';
		}

	}



 ?>