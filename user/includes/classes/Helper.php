<?php 

class Helper{

	public static function site_name(){
		return "Wealth Fusion";
	}

	public static function site_logo(){
		return "https://thewealthfusion.com/assets/global/images/hH42szx7wOd36BuyKWHJ.png";
	}

	public static function site_url(){
		return "https://thewealthfusion.com/";
	}
	public static function referral($unik){
		return Helper::site_url()."register?ref=$unik";
	}

	public static function site_email(){
		return "support@thewealthfusion.com";
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

	public static function dateTime(){
        return date("M d, Y h:i a");
    }

	public static function defaultQrcode($slug){
        return "assets/img/qrcode/alt/$slug.png";
    }

}






 ?>