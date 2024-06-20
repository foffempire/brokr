<?php
require_once "includes/init.php";
define("PAGE","plans");

if(!logged_in()){
    Helper::redirect("../login");
}
// get schemas
$qr = $kon->prepare("SELECT * FROM plans");
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
                    <h3 class="title">All The Schemas</h3>
                </div>
                <div class="site-card-body">
                    <div class="row">
                        <?php foreach ($rows as $row) { ?>
                            <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="single-investment-plan">
                                    <img
                                    class="investment-plan-icon"
                                    src="../assets/global/images/tnXj8aLxsIzD1HKxfpEO.png"
                                    alt=""
                                    />
    
                                    <h3><?= $row['name'] ?></h3>
                                    <p>Daily <?= $row['percentage'] ?>%</p>
                                    <ul>
                                    <li>Investment <span class="special"> $<?= $row['min'] ?>-$<?= $row['max'] ?> </span></li>
                                    <li>Capital Back <span>Yes</span></li>
                                    <li>Return Type <span>Period</span></li>
                                    <li>
                                        Number of Period
                                        <span>3 Times</span>
                                    </li>
                                    <li>Profit Withdraw <span>Anytime</span></li>
                                    </ul>
                                    <div class="holidays">
                                    <span class="star">*</span> <?= $row['note'] ?>
                                    </div>
                                    <a href="./schema-preview?id=<?= $row['id'] ?>" class="site-btn grad-btn w-100 centered"
                                    ><i class="anticon anticon-check"></i>Invest Now</a
                                    >
                                </div>
                            </div>
                        <?php } ?>
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