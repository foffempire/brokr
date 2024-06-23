<?php
require_once "includes/init.php";
define("PAGE","deposit");

if(!logged_in()){
    Helper::redirect("../login");
}
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
                    <h3 class="title">Add Money</h3>
                    <div class="card-header-links">
                        <a href="./deposit-log"
                           class="card-header-link">Deposit History</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps">
                        <div class="single-step ">
                            <div class="number">01</div>
                            <div class="content">
                                <h4>Deposit Amount</h4>
                                <p>Enter your deposit details</p>
                            </div>
                        </div>
                        <div class="single-step current">
                            <div class="number">02</div>
                            <div class="content">
                                <h4>Success</h4>
                                <p>Success Your Deposit</p>
                            </div>
                        </div>
                    </div>
                    <div class="progress-steps-form">
                        <p>
                            <i>
                            We are reviewing your transaction. You will be notified if your deposit is successful.
                            </i>
                        </p>
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
    
</div>
<!--/Full Layout-->

<?php require_once('includes/components/footer.php') ?>
