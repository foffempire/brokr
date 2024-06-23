<?php  

	/**
	 * 
	 */
	class Transaction 
	{
		private $kon;
		private $tid;
		private $data;

		function __construct($kon, $tid=null)
		{
			$this->kon = $kon;
			$this->tid =$tid;

			$stmt = $this->kon->prepare("SELECT * FROM transactions WHERE id = :id ");
			$stmt->bindParam("id", $this->tid);
			$stmt->execute();

			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}


		public function id(){
			return $this->data['id'];
		}

        function addTransaction($email, $type, $amount, $fee, $status, $gateway){
            $date = Helper::dateTime();
            $tid = strtoupper(Helper::randomString(10));
            $insert = $this->kon->prepare("INSERT INTO transactions (email, transaction_id, type, amount, fee, status, gateway, datetime) VALUES (:email, :tid, :typ, :amt, :fee, :stat, :gate, :dt )");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":tid", $tid);
            $insert->bindParam(":typ", $type);
            $insert->bindParam(":amt", $amount);				
            $insert->bindParam(":fee", $fee);				
            $insert->bindParam(":stat", $status);				
            $insert->bindParam(":gate", $gateway);				
            $insert->bindParam(":dt", $date);				
            return $insert->execute();
        }


        function addDeposit($email, $type, $amount, $fee, $status, $gateway, $imgName){
            $date = Helper::dateTime();
            $tid = strtoupper(Helper::randomString(10));
            $insert = $this->kon->prepare("INSERT INTO deposit (email, transaction_id, type, amount, fee, status, gateway, image, datetime) VALUES (:email, :tid, :typ, :amt, :fee, :stat, :gate, :img, :dt )");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":tid", $tid);
            $insert->bindParam(":typ", $type);
            $insert->bindParam(":amt", $amount);				
            $insert->bindParam(":fee", $fee);				
            $insert->bindParam(":stat", $status);				
            $insert->bindParam(":gate", $gateway);				
            $insert->bindParam(":img", $imgName);				
            $insert->bindParam(":dt", $date);				
            return $insert->execute();
        }

        function addwithdrawal($email, $gateway, $amount, $address, $status){
            $date = Helper::dateTime();
            $tid = strtoupper(Helper::randomString(10));
            $insert = $this->kon->prepare("INSERT INTO withdrawals (email, transaction_id, wallet_type, wallet_address, amount, status, date_added) VALUES (:email, :tid, :typ, :addr, :amt, :stat, :dt )");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":tid", $tid);
            $insert->bindParam(":typ", $gateway);
            $insert->bindParam(":addr", $address);		
            $insert->bindParam(":amt", $amount);				
            $insert->bindParam(":stat", $status);				
            $insert->bindParam(":dt", $date);				
            return $insert->execute();
        }

	}

?>