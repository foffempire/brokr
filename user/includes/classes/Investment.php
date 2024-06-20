<?php  

	/**
	 * 
	 */
	class Investment 
	{
		private $kon;
		private $iid;
		private $data;

		function __construct($kon, $iid=null)
		{
			$this->kon = $kon;
			$this->iid =$iid;

			$stmt = $this->kon->prepare("SELECT * FROM investments WHERE id = :id ");
			$stmt->bindParam("id", $this->iid);
			$stmt->execute();

			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}


        function profitInvest($email, $amount, $plan, $gateway, $status, $rate){
            $done= $this->updateProfitAfterInvestment($email, $amount);
            if($done){
                $completed = $this->addInvestment($email, $amount, $plan, $gateway, $status, $rate);
                if($completed){
                    return true;
                }
            }
        }
        function mainInvest($email, $amount, $plan, $gateway, $status, $rate){
            $done= $this->updateBalAfterInvestment($email, $amount);
            if($done){
                $completed = $this->addInvestment($email, $amount, $plan, $gateway, $status, $rate);
                if($completed){
                    return true;
                }
            }
        }
        function addInvestment($email, $amount, $plan, $gateway, $status, $rate){
            $date = Helper::dateTime();
            $tid = strtoupper(Helper::randomString(10));
            $insert = $this->kon->prepare("INSERT INTO investments(email, transaction_id, amount, package, gateway, status, rate, date_added) VALUE(:email, :tid, :amt, :plan, :gate, :stat, :rate, :dt)");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":tid", $tid);
            $insert->bindParam(":amt", $amount);				
            $insert->bindParam(":plan", $plan);				
            $insert->bindParam(":gate", $gateway);				
            $insert->bindParam(":stat", $status);				
            $insert->bindParam(":rate", $rate);				
            $insert->bindParam(":dt", $date);				
            return $insert->execute();
        }

        function updateBalAfterInvestment($email, $amount){
            $uza = new User($this->kon, $email);
            $currentBal = $uza->bal();
            $newBal = $currentBal - $amount;
            $insert = $this->kon->prepare("UPDATE users SET bal = :bal WHERE email = :email");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":bal", $newBal);			
            return $insert->execute();
        }
        function updateProfitAfterInvestment($email, $amount){
            $uza = new User($this->kon, $email);
            $currentProfit = $uza->profit();
            $newProfit = $currentProfit - $amount;
            $insert = $this->kon->prepare("UPDATE users SET profit = :prof WHERE email = :email");
            $insert->bindParam(":email", $email);
            $insert->bindParam(":prof", $newProfit);			
            return $insert->execute();
        }

	}

?>