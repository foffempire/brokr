<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Edit Plan"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }


    if (isset($_GET['edit_plan'])) {
    	$planID = $_GET['edit_plan'];
    }else{
    	Helper::redirect("plans");
    }



    if (isset($_POST['update_plan'])) {
        $name = Sanitizer::sanitizeInput($_POST['name']);
        $from = Sanitizer::sanitizeInput($_POST['from']);
        $to = Sanitizer::sanitizeInput($_POST['to']);

        if (empty($name)  || empty($from) || empty($to)) {
            $_SESSION['error'] = "All fields are required";
        }else{
            $stmt = $kon->prepare("UPDATE plans SET name = :name, amount= :frm, returns= :to WHERE id = :pid");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":frm", $from);
            $stmt->bindParam(":to", $to);
            $stmt->bindParam(":pid", $planID);
			$done = $stmt->execute();
			if($done){
				Helper::redirect("plans");
			}
        }


        

    }


$kweri = $kon->prepare("SELECT * FROM plans WHERE id = '$planID' ");
$kweri->execute();
$row = $kweri->fetch(PDO::FETCH_ASSOC);
?>
<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">

        <div class="container">
            <hr>
            <h6>Edit plan</h6>
            <?= Helper::alert() ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group my-3">
                    <label class="py-2" for="">Plan name</label>
                    <input type="text" name="name" placeholder="eg Basic" value="<?= $row['name'] ?>" class="form-control" required>
                </div>

                <div class="form-group my-3">
                    <label class="py-2" for="">From</label>
                    <input type="number" name="from" placeholder="50" value="<?= $row['amount'] ?>" class="form-control" required>
                </div>

                <div class="form-group my-3">
                    <label class="py-2" for="">To</label>
                    <input type="number" name="to" placeholder="500" value="<?= $row['returns'] ?>" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" name="update_plan">SEND</button>
            </form>
        </div>
    </div>
</div>
    <!-- main content end -->


<?php require_once("includes/components/footer.php") ?>
