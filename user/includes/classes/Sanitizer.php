<?php 

	
	class Sanitizer{

		public static function sanitizeInput($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}


		public static function sanitizeName($data){
			$data = stripslashes($data);		
			$data = htmlspecialchars($data);
			$data = str_replace(" ", "", $data);
			$data = strtolower($data);
			$data = ucfirst($data);
			return $data;
		}

		public static function sanitizeEmail($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$data = strtolower($data);
			return $data;
		}		


	}






 ?>