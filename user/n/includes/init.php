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
error_reporting(0);



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


// *************random string****************
$rand_str=Helper::randomString(10);

