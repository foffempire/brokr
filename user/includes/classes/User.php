<?php  

	/**
	 * 
	 */
	class User 
	{
		private $kon;
		private $email;
		private $data;

		function __construct($kon, $email)
		{
			$this->kon = $kon;
			$this->email =$email;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em ");
			$stmt->bindParam("em", $this->email);
			$stmt->execute();

			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}


		public function id(){
			return $this->data['user_id'];
		}
		public function password(){
			return $this->data['password'];
		}

		public function firstname(){
			return $this->data['firstname'];
		}

		public function lastname(){
			return $this->data['lastname'];
		}
		public function middlename(){
			return $this->data['middlename'];
		}

		public function fullname(){
			return $this->firstname()." ".$this->lastname();
		}

		public function email(){			
			return $this->data['email'];
		}
		public function username(){			
			return $this->data['username'];
		}

		public function phone(){
			return $this->data['phone'];
		}
		public function address(){
			return $this->data['addr'];
		}
		public function city(){
			return $this->data['city'];
		}
		public function state(){
			return $this->data['state'];
		}
		public function country(){
			return $this->data['country'];
		}
		public function occupation(){
			return $this->data['occupation'];
		}
		public function dob(){
			return $this->data['dob'];
		}
		public function pinCode(){
			return $this->data['transaction_pin'];
		}
		public function bal(){
			return $this->data['bal'];
		}
		public function profit(){
			return $this->data['profit'];
		}
		public function rate(){
			return $this->data['profit_rate'];
		}
		public function unik(){
			return $this->data['unique_id'];
		}
		public function image(){
			return $this->data['image'];
		}
		public function zip(){
			return $this->data['zipcode'];
		}

		public function regDate(){
			return $this->data['reg_date'];
		}
		public function bonusalert(){
			if($this->data['bonusalert'] == 0){
				return '<section class="auto-popup-section">
				<div class="auto-popup-dialog-inner" style="background: url(../assets/frontend/images/auto-pop.jpg) no-repeat;">
						<div class="row">
							<div class="col-md-12 col-12">
								<div class="auto-pop-content">
									<h2>Congratulation!</h2>
									<h3>You got a Signup Bonus
										<span>10 USD</span></h3>
										<a href="?updt">
									<button class="site-btn grad-btn auto-popup-close-now"><i class="anticon anticon-check"></i> Got it</button>
									</a>
								</div>
							</div>
						</div>
					</div>
			</section>';
			}else{
				return '';
			}
		}

		public function profileNotUpdated(){
			if(is_null($this->data['firstname']) && is_null($this->data['country'])){
				return true;
			}
		}

		public function isVerified(){
			return $this->data['is_verified'];
		}

		public function isActive(){
			return $this->data['is_active'];
		}

		public function countReferral(){
			$unikID = $this->unik();
			$query = $this->kon->prepare("SELECT * FROM users WHERE referrer = :ref ");
			$query->bindParam("ref", $unikID);
			$query->execute();
			$rows = $query->fetchAll(PDO::FETCH_ASSOC);
			return count($rows);
		}


		public function updateProfile($firstname, $lastname,$username, $phone, $image, $city, $state, $address, $gender, $dob, $zipcode){
			$stmt = $this->kon->prepare("UPDATE users SET firstname = :fn, lastname = :ln, username = :mn, dob = :dob, phone = :ph, addr = :addr, state = :st, image = :img, city = :cty, gender = :gender, zipcode = :zipcode WHERE email = :em ");
			$stmt->bindParam(":fn", $firstname);
			$stmt->bindParam(":ln", $lastname);
			$stmt->bindParam(":mn", $username);
			$stmt->bindParam(":ph", $phone);
			$stmt->bindParam(":img", $image);
			$stmt->bindParam(":cty", $city);
			$stmt->bindParam(":st", $state);
			$stmt->bindParam(":addr", $address);
			$stmt->bindParam(":gender", $gender);
			$stmt->bindParam(":dob", $dob);
			$stmt->bindParam(":zipcode", $zipcode);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}

		function debitMainBal($amount){
			$newBal = $this->bal() - $amount;
			$stmt = $this->kon->prepare("UPDATE users SET bal = :bal WHERE email = :em ");
			$stmt->bindParam(":bal", $newBal);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}
		function creditMainBal($amount){
			$newBal = $this->bal() + $amount;
			$stmt = $this->kon->prepare("UPDATE users SET bal = :bal WHERE email = :em ");
			$stmt->bindParam(":bal", $newBal);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}

		function debitProfitBal($amount){
			$newBal = $this->profit() - $amount;
			$stmt = $this->kon->prepare("UPDATE users SET profit = :bal WHERE email = :em ");
			$stmt->bindParam(":bal", $newBal);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}
		function creditProfitBal($amount){
			$newBal = $this->profit() + $amount;
			$stmt = $this->kon->prepare("UPDATE users SET profit = :bal WHERE email = :em ");
			$stmt->bindParam(":bal", $newBal);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}


		function verifyPassword($pw){
			//$pw = md5($pw);

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND password = :pw ");
			$stmt->bindParam(":em", $this->email);
			$stmt->bindParam(":pw", $pw);
			$stmt->execute();

			if($stmt->rowCount() == 1){
				return true;				
			}
		}

		public function updatePassword($pass){
			$stmt = $this->kon->prepare("UPDATE users SET password = :pw WHERE email = :em ");
			$stmt->bindParam(":pw", $pass);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}

		public function updatePinCode($pin){
			$stmt = $this->kon->prepare("UPDATE users SET transaction_pin = :pin WHERE email = :em ");
			$stmt->bindParam(":pin", $pin);
			$stmt->bindParam(":em", $this->email);
			return $stmt->execute();
		}


		function verifyPin($pin){
			$stmt = $this->kon->prepare("SELECT * FROM users WHERE email = :em AND transaction_pin = :pin ");
			$stmt->bindParam(":em", $this->email);
			$stmt->bindParam(":pin", $pin);
			$stmt->execute();

			if($stmt->rowCount() == 1){
				return true;				
			}
		}

		function updateBonusAlert(){
			$bonus = 1;
			$stmt = $this->kon->prepare("UPDATE users SET bonusalert = :bna WHERE email = :em ");
			$stmt->bindParam(":em", $this->email);
			$stmt->bindParam(":bna", $bonus);
			return $stmt->execute();
		}

	}

?>