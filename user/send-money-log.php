<?php
require_once "includes/init.php";
define("PAGE","sendlog");

if(!logged_in()){
    Helper::redirect("../login");
}


// recent transaction
$qr = $kon->prepare("SELECT * FROM send_money WHERE sender = :em ORDER BY id DESC");
$qr->bindParam("em", $email);
$qr->execute();
$rows=$qr->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once('includes/components/header.php') ?>

    <!--Side Nav-->
<?php require_once('includes/components/sidebar.php') ?>
    <!--/Side Nav-->

    <div class="page-container">
        <div class="main-content">
            <div class="section-gap">
                <div class="container-fluid">
                    <div class="row">
                        <?php $kyc = new Kyc($kon, $email); echo $kyc->isUpdated() ?>
    </div>
                                        <!--Page Content-->
                        <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">All Send Money Log</h3>
                </div>
                <div class="site-card-body">
                    <div class="site-datatable">
                        <div class="row table-responsive">
                            <div class="col-xl-12">
                                <table id="dataTable" class="display data-table">
                                    <thead>
                                    <tr>
                                        <th>Beneficiary</th>
                                        <th>Transactions ID</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $key) { ?>
                                            <tr>
                                                <td><?= $key['receiver'] ?></td>
                                                <td><?= $key['tid'] ?></td>
                                                <td><?= $key['amount'] ?> USD</td>
                                                <td>0 USD</td>
                                                <td >Completed</td>
                                                <td><?= $key['date_added'] ?></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    <!--Page Content-->
                </div>
            </div>
        </div>
    </div>


    <!-- Automatic Popup -->
    
    <!-- /Automatic Popup End -->
</div>
<!--/Full Layout-->
<?php require_once('includes/components/footer.php') ?>