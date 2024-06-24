<?php
require_once("includes/init.php");

if(isset($_POST['coin']) && isset($_POST['amt'])){
	$slug = Sanitizer::sanitizeInput($_POST['coin']);
	$val = Sanitizer::sanitizeInput($_POST['amt']);
	$addr = Sanitizer::sanitizeInput($_POST['addr']);
	$id = Sanitizer::sanitizeInput($_POST['id']);

	$coin = new Coin($kon, $id);
	if (empty($slug) || empty($val) || empty($id) || empty($addr)) {
		echo "All fields are required";
	}elseif (!is_numeric($val)) {
		echo "Enter a valid amount";
	}else{
		$wasSuccessful = $coin->updateTransaction($val, $slug, $addr);
		if($wasSuccessful){
			echo "Successful";
		}
	}
}

elseif (isset($_GET['del_wallet'])) {
	$id = $_GET['del_wallet'];
	$wallet = new Wallet($kon);
	$wasSuccessful = $wallet->delete($id);
	if($wasSuccessful){
		Helper::redirect('add_wallet');
	}
}


elseif (isset($_GET['confirmId']) && isset($_GET['userId'])) {
	$id = $_GET['confirmId'];
	$uid = $_GET['userId'];
	$tr = new Transactions($kon, $uid);
	$wasSuccessful = $tr->confirmTransaction($id);
	if($wasSuccessful){
		Helper::redirect("trans_info?id=$id");
	}
}

// ***********************Investments**************************
elseif (isset($_GET['confirmInvest'])) {
	$id = $_GET['confirmInvest'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->confirmInvest($id);
	if($wasSuccessful){
		Helper::redirect("invest?query=pending");
	}
}

elseif (isset($_GET['runningInvest'])) {
	$id = $_GET['runningInvest'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->runningInvest($id);
	if($wasSuccessful){
		Helper::redirect("invest?query=pending");
	}
}

elseif (isset($_GET['undoConfirmInvest'])) {
	$id = $_GET['undoConfirmInvest'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->undoConfirmInvest($id);
	if($wasSuccessful){
		Helper::redirect("invest?query=pending");
	}
}
elseif (isset($_GET['deleteInvest'])) {
	$id = $_GET['deleteInvest'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->deleteInvest($id);
	if($wasSuccessful){
		Helper::redirect("invest?query=pending");
	}
}

// ***********************Investments**************************
elseif (isset($_GET['confirmwithdraw'])) {
	$id = $_GET['confirmwithdraw'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->confirmwithdraw($id);
	if($wasSuccessful){
		Helper::redirect("withdraw?query=pending");
	}
}

elseif (isset($_GET['undoConfirmwithdraw'])) {
	$id = $_GET['undoConfirmwithdraw'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->undoConfirmwithdraw($id);
	if($wasSuccessful){
		Helper::redirect("withdraw?query=pending");
	}
}
elseif (isset($_GET['deletewithdraw'])) {
	$id = $_GET['deletewithdraw'];
	$t = new Transactions($kon);
	$wasSuccessful = $t->deletewithdraw($id);
	if($wasSuccessful){
		Helper::redirect("withdraw?query=pending");
	}
}

// ***********************deposit**************************
elseif (isset($_GET['confirmDeposit'])) {
	$id = $_GET['confirmDeposit'];
	$stat = "completed";
	$query = $kon->prepare("UPDATE deposit SET status = :stat WHERE id = :id ");
	$query->bindParam(":stat", $stat);
	$query->bindParam(":id", $id);
	$wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("deposit");
	}
}
elseif (isset($_GET['unConfirmDeposit'])) {
	$id = $_GET['unConfirmDeposit'];
	$stat = "pending";
	$query = $kon->prepare("UPDATE deposit SET status = :stat WHERE id = :id ");
	$query->bindParam(":stat", $stat);
	$query->bindParam(":id", $id);
	$wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("deposit");
	}
}
elseif (isset($_GET['deleteDeposit'])) {
	$id = $_GET['deleteDeposit'];
	$query = $kon->prepare("DELETE FROM deposit WHERE id = :id ");
    $query->bindParam(":id", $id);
    $wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("deposit");
	}
}


// ***********************KYC**************************
elseif (isset($_GET['confirmKYC'])) {
	$id = $_GET['confirmKYC'];
	$stat = "Approved";
	$query = $kon->prepare("UPDATE kyc SET status = :stat WHERE id = :id ");
	$query->bindParam(":stat", $stat);
	$query->bindParam(":id", $id);
	$wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("kyc");
	}
}
elseif (isset($_GET['rejectKYC'])) {
	$id = $_GET['rejectKYC'];
	$stat = "Rejected";
	$query = $kon->prepare("UPDATE kyc SET status = :stat WHERE id = :id ");
	$query->bindParam(":stat", $stat);
	$query->bindParam(":id", $id);
	$wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("kyc");
	}
}
elseif (isset($_GET['unConfirmKYC'])) {
	$id = $_GET['unConfirmKYC'];
	$stat = "Under review";
	$query = $kon->prepare("UPDATE kyc SET status = :stat WHERE id = :id ");
	$query->bindParam(":stat", $stat);
	$query->bindParam(":id", $id);
	$wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("kyc");
	}
}
elseif (isset($_GET['deleteKYC'])) {
	$id = $_GET['deleteKYC'];
	$query = $kon->prepare("DELETE FROM kyc WHERE id = :id ");
    $query->bindParam(":id", $id);
    $wasSuccessful = $query->execute();
	if($wasSuccessful){
		Helper::redirect("kyc");
	}
}


// ***********************block user**************************
elseif (isset($_GET['blockUser'])) {
	$id = $_GET['blockUser'];
	$t = new Users($kon, $id);
	$wasSuccessful = $t->blockUser();
	if($wasSuccessful){
		Helper::redirect("userDetail?id=$id");
	}
}
elseif (isset($_GET['unBlockUser'])) {
	$id = $_GET['unBlockUser'];
	$t = new Users($kon, $id);
	$wasSuccessful = $t->unBlockUser();
	if($wasSuccessful){
		Helper::redirect("userDetail?id=$id");
	}
}

// ***********************delete user**************************
elseif (isset($_GET['delUser'])) {
	$id = $_GET['delUser'];
	$t = new Users($kon, $id);
	$wasSuccessful = $t->deleteUser();
	if($wasSuccessful){
		Helper::redirect("dashboard");
	}
}