<?php  

	/**
	 * 
	 */
	class Admin 
	{
		private $kon;
		private $email;

		function __construct($kon, $email)
		{
			$this->kon = $kon;
			$this->email =$email;

			$stmt = $this->kon->prepare("SELECT * FROM admin_user WHERE email = :em ");
			$stmt->bindParam("em", $this->email);
			$stmt->execute();

			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}


		public function id(){
			return $this->data['id'];
		}

		public function email(){			
			return $this->data['email'];
		}

		public function level(){			
			return $this->data['level'];
		}

	}







?>