<?php 
require_once "includes/init.php";


session_destroy();
setcookie("crypBroke", "", time() - (86400 * 1), "/");
Helper::redirect("../login");

 ?>