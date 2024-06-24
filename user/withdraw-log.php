<?php
require_once "includes/init.php";
define("PAGE","withdrawlog");

if(!logged_in()){
    Helper::redirect("../login");
}


// query investments
$stmt = $kon->prepare("SELECT * FROM withdrawals WHERE email = :email ORDER BY id DESC");
$stmt->bindParam("email", $email);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <h3 class="title">All Withdrawals</h3>
                </div>
                <div class="site-card-body">
                    <div class="site-datatable">
                        <div class="row table-responsive">
                            <div class="col-xl-12">
                                <table id="dataTable" class="display data-table">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Transactions ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Method</th>
                                        <th>Wallet Address</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($rows as $row) { ?>
                                <tr>
                                <td>
                                    <div class="table-description">
                                        <div class="icon">
                                            <i icon-name="backpack
                                         ">
                                            </i>
                                        </div>


                                        <div class="description">
                                            <strong><?= 'Withdrawal' ?></strong>
                                            <div class="date"><?= $row['date_added'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><strong><?= $row['transaction_id'] ?></strong></td>

                                <td><strong
                                        class="green-color">+<?= $row['amount'] ?> USD</strong>
                                </td>
                                <td>
                                    <div class="site-badge success"><?= $row['status'] ?></div>
                                                                    </td>
                                <td><strong><?= $row['wallet_type'] ?></strong></td>
                                <td><strong><?= $row['wallet_address'] ?></strong></td>
                            </tr>
                            <?php } ?>

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