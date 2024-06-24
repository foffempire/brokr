<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Manage Plans"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }


    if (isset($_GET['del_plan'])) {
    	$planID = $_GET['del_plan'];
    	$qw = $kon->prepare("DELETE FROM plans WHERE id = '$planID' ");
		$done = $qw->execute();
		if($done){
			Helper::redirect("plans");
		}
    }


    if (isset($_POST['add_plan'])) {
        $name = Sanitizer::sanitizeInput($_POST['name']);
        $from = Sanitizer::sanitizeInput($_POST['from']);
        $to = Sanitizer::sanitizeInput($_POST['to']);

        if (empty($name)  || empty($from) || empty($to)) {
            $_SESSION['error'] = "All fields are required";
        }else{
            $stmt = $kon->prepare("INSERT INTO plans(name, amount, returns) VALUES(:name, :frm, :to)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":frm", $from);
            $stmt->bindParam(":to", $to);
			$done = $stmt->execute();
			if($done){
				Helper::redirect("plans");
			}
        }


        

    }


$kweri = $kon->prepare("SELECT * FROM plans");
$kweri->execute();
$rows = $kweri->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">

        <div class="container">
        <h6>All Plans</h6>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Plan Name</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rows as $row) { ?>
	                     <tr>
		                    <td><?= $row['name'] ?></td>
		                    <td><?= $row['amount'] ?></td>
		                    <td><?= $row['returns'] ?></td>
		                    <td>
		                        <a href='plan_edit?edit_plan=<?= $row['id'] ?>'><button class='btn btn-sm btn-primary'>Edit</button></a>

		                        <a href='plans?del_plan=<?= $row['id'] ?>' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>
		                    </td>
	                	</tr>             
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="container">
            <hr>
            <h6>Add plan</h6>
            <?= Helper::alert() ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group my-3">
                    <label class="py-2" for="">Plan name</label>
                    <input type="text" name="name" placeholder="eg Basic" class="form-control" required>
                </div>

                <div class="form-group my-3">
                    <label class="py-2" for="">From</label>
                    <input type="number" name="from" placeholder="50" class="form-control" required>
                </div>

                <div class="form-group my-3">
                    <label class="py-2" for="">To</label>
                    <input type="number" name="to" placeholder="500" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" name="add_plan">SEND</button>
            </form>
        </div>
    </div>
</div>
    <!-- main content end -->


<?php require_once("includes/components/footer.php") ?>
