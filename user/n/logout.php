<?php 
require_once "includes/init.php";


session_destroy();
setcookie("adminLogin", "", time() - (86400 * 1), "/");
helper::redirect("login");

 ?>