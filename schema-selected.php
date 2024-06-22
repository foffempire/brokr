<?php 
require_once("user/includes/init.php");

$result =[];
if(isset($_GET['plan'])){
    $id = $_GET['plan'];
}else{
    $id = 1;
}
$qr= $kon->prepare("SELECT * FROM plans WHERE id = :id");
$qr->bindParam(":id", $id);
$qr->execute();
$row = $qr->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);




?>