<?php  

	/**
	 * 
	 */
	class Users 
	{
		private $kon;
		private $id;

		function __construct($kon, $id="")
		{
			$this->kon = $kon;
			$this->id =$id;

			$stmt = $this->kon->prepare("SELECT * FROM users WHERE user_id = :id ");
			$stmt->bindParam(":id", $id);
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
		public function isActive(){
			return $this->data['is_active'];
		}
		public function regDate(){
			return $this->data['reg_date'];
		}

		public function profileNotUpdated(){
			if(is_null($this->data['firstname']) && is_null($this->data['country'])){
				return true;
			}
		}

		function editBal($amt){
			$stmt = $this->kon->prepare("UPDATE users SET bal = :amt WHERE user_id = :id");
			$stmt->bindParam(":amt", $amt);
			$stmt->bindParam(":id", $this->id);
			return $stmt->execute();
		}

		function editProfit($profit, $rate){
			$stmt = $this->kon->prepare("UPDATE users SET profit = :prof, profit_rate = :rate WHERE user_id = :id");
			$stmt->bindParam(":prof", $profit);
			$stmt->bindParam(":rate", $rate);
			$stmt->bindParam(":id", $this->id);
			return $stmt->execute();
		}
		
		function deleteUser(){
			$stmt = $this->kon->prepare("DELETE FROM users WHERE user_id = $this->id");
			return $stmt->execute();
		}
		function blockUser(){
			$stmt = $this->kon->prepare("UPDATE users SET is_active = 0 WHERE user_id = $this->id");
			return $stmt->execute();
		}
		function unBlockUser(){
			$stmt = $this->kon->prepare("UPDATE users SET is_active = 1 WHERE user_id = $this->id");
			return $stmt->execute();
		}

		function allUsers(){
			$stmt = $this->kon->prepare("SELECT * FROM users ");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$n = 0;
			if(empty($rows)){
				echo "No registered user";
			}else{
				foreach ($rows as $row) {
					$fn = $row['firstname']." ".$row['lastname'];
					$email = $row['email'];
					$id = $row['user_id'];
					$location = $row['country'];
					$bal = $row['bal'];
					$n++;

				echo "<tr>
						<td>$n</td>
						<td>$fn</td>
						<td>$email</td>
						<td>$location</td>
						<td>$$bal</td>
						<td>
							<a href='userDetail?id=$id'><button class='btn btn-sm btn-primary'>View</button></a>
						</td>
			        </tr>";
				}
			}
		}

	}







?>