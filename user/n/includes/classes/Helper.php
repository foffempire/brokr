<?php 

class Helper{

	public static function site_name(){
		return "Wealth Fusion";
	}

	public static function site_url(){
		return "https://flipearners.com/";
	}

	public static function redirect($location){
		header("location: $location");
	}

	public static function alert(){
		if (isset($_SESSION['error'])) {
			echo '<div class="alert alert-danger" role="alert">' .$_SESSION['error'].'</div>';
		   unset($_SESSION['error']);
		}elseif (isset($_SESSION['success'])) {
			echo '<div class="alert alert-success" role="alert">' .$_SESSION['success'].'</div>';
		   unset($_SESSION['success']);
		}
	 }

	 public static function randomString($length){
		$string = "QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm1234567890";
        return $order_unique_id = substr(str_shuffle($string), 0, $length);
	 }

}






 ?>