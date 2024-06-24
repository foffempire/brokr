<?php
require_once "db_config.php";




// ************PDO connection************
try {
	$kon = new PDO("mysql:host=".HOST.";dbname=".DBNAME."","".DBUSER."","".DBPASS."");
} catch (PDOException $e) {
	echo "cannot connect: " . $e->getMessage();
	exit();
}



// ****************initialization****************
date_default_timezone_set('America/New_York');
//error_reporting(0);



// ******************logged in function******************
function logged_in(){
	if (isset($_SESSION['adminLogin']) || isset($_COOKIE['adminLogin'])) {
		$email = $_COOKIE['adminLogin'];
		$_SESSION['adminLogin'] = $email;
		return true;
	}else{
		return false;
	}
}



// ******************login check & set email******************
if(logged_in()){
	$email = $_SESSION['adminLogin'];
}



// *************load all classes (autoload)****************

spl_autoload_register(function($class_name){
	include "classes/$class_name.php";
});


// *************load all classes (manually)****************
// require_once "includes/classes/Account.php";
// require_once "includes/classes/User.php";
// require_once "includes/classes/helper.php";
// require_once "includes/classes/category.php";
// require_once "includes/classes/Sanitizer.php";
// require_once "includes/classes/product.php";
// require_once "includes/classes/cart.php";
// require_once "includes/classes/insert_product.php";
// require_once "includes/classes/product.php";
// require_once "includes/classes/list_products.php";
// require_once "includes/classes/comments.php";


// *************paystack live key constant****************
//define("SECRET_KEYZ", "sdfngi74ryi7w4rnow8fowefu9w48ur9wofisnhdjshdjfn834r");


// *************random string****************
$rand_str=Helper::randomString(10);


// ******************update live prices in USD********************
function updateLivePrice(){
	global $kon;
	$btcVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=bitcoin&vs_currencies=usd");
	$ethVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=ethereum&vs_currencies=usd");
	$ltcVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=litecoin&vs_currencies=usd");
	$xrpVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=ripple&vs_currencies=usd");
	$bchVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=bitcoin-cash&vs_currencies=usd");
	$usdcVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=usd-coin&vs_currencies=usd");
	$usdtVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=tether&vs_currencies=usd");
	$dogeVal = Helper::usdRate("https://coingecko.p.rapidapi.com/simple/price?ids=dogecoin&vs_currencies=usd");
	$date = date("Y-m-d H:i:s");
    
	if($ltcVal !=1015 && $btcVal !=1015 ){
		if(is_numeric($ltcVal) && is_numeric($btcVal) && is_numeric($dogeVal)){            
			$id = 1;
			$query = $kon->prepare("UPDATE usd_value SET btc=:btc, eth=:eth, xrp=:xrp, bch=:bch, ltc=:ltc, doge=:doge, usdc=:usdc, usdt=:usdt, date_updated = :dt  WHERE id = :id ");
			$query->bindParam(":btc", $btcVal);
			$query->bindParam(":eth", $ethVal);
			$query->bindParam(":xrp", $xrpVal);
			$query->bindParam(":bch", $bchVal);
			$query->bindParam(":ltc", $ltcVal);
			$query->bindParam(":usdc", $usdcVal);
			$query->bindParam(":usdt", $usdtVal);
			$query->bindParam(":doge", $dogeVal);
			$query->bindParam(":dt", $date);
			$query->bindParam(":id", $id);
			$query->execute();
		}
	}
}

//updateLivePrice();
