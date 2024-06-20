<?php  

	/**
	 * 
	 */
	class Kyc 
	{
		private $kon;
		private $email;
		private $data;
        private $count;

		function __construct($kon, $email)
		{
			$this->kon = $kon;
			$this->email =$email;

			$stmt = $this->kon->prepare("SELECT * FROM kyc WHERE email = :em ORDER BY id DESC LIMIT 1");
			$stmt->bindParam("em", $this->email);
			$stmt->execute();
            $this->count = $stmt->rowCount();
			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		function hasDoneKYC(){
			if($this->count > 0 ){
                return true;
            }
		}
		public function isUpdated(){
            if($this->count < 1 || $this->status() == "Rejected" ){
                return '
                <div class="col">
                    <div class="alert site-alert alert-dismissible fade show" role="alert">
                        <div class="content">
                        <div class="icon"><i class="anticon anticon-warning"></i></div>
                        You need to submit your
                        <strong>KYC and Other Documents</strong> before proceed to the system.
                        </div>
                        <div class="action">
                        <a href="./kyc" class="site-btn-sm grad-btn"
                            ><i class="anticon anticon-info-circle"></i>Submit Now</a
                        >
                        <a
                            href=""
                            class="site-btn-sm red-btn ms-2"
                            type="button"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                            ><i class="anticon anticon-close"></i>Later</a
                        >
                        </div>
                    </div>
                    </div>
                ';
            }else {
                return '';
            }
		}
		public function shouldUploadKYC(){
			if($this->count < 1 || $this->status() == "Rejected" ){
                return true;
            }
		}
		public function fullname(){
			return $this->data['fullname'];
		}

		public function image(){
			return $this->data['image'];
		}

		public function type(){
			return $this->data['verify_type'];
		}
		public function status(){
			return $this->data['status'];
		}

        public function updateKYC($type, $fullnames,$imageName){
            $email = $this->email;
			$stmt = $this->kon->prepare("INSERT INTO kyc(email, verify_type, fullnames, image) VALUES(:email, :typ, :fn, :img) ");
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":typ", $type);
			$stmt->bindParam(":fn", $fullnames);
			$stmt->bindParam(":img", $imageName);
			return $stmt->execute();
		}

	}

?>