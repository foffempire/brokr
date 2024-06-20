<?php
require_once "includes/init.php";
define("PAGE","send");

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
                    <h3 class="title">Send Money</h3>
                    <div class="card-header-links">
                        <a href="./send-money-log"
                           class="card-header-link">SEND MONEY LOG</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps">
                        <div class="single-step ">
                            <div class="number">01</div>
                            <div class="content">
                                <h4>Payment Details</h4>
                                <p>Enter your Payment details</p>
                            </div>
                        </div>
                        <div class="single-step current">
                            <div class="number">02</div>
                            <div class="content">
                                <h4>Success</h4>
                                <p>Successfully Payment</p>
                            </div>
                        </div>
                    </div>
                    
    <div class="progress-steps-form">
    <div class='alert alert-success alert-dismissible fade show' role='alert'>Money sent successfully! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>
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