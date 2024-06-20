<?php
require_once "includes/init.php";
define("PAGE","support");

if(!logged_in()){
    Helper::redirect("../login");
}
if(isset($_GET['tid'])){
    $tid = $_GET['tid'];
}
else{
    Helper::redirect("support-ticket-new");
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
                                <h3 class="title">Successful</h3>
                                <div class="card-header-links">
                                <a href="./support-ticket" class="card-header-link">All Tickets</a>
                                </div>
                            </div>
                            <div class="site-card-body">
                                <div class="progress-steps-form">
                                <div class='alert alert-success alert-dismissible fade show' role='alert'><h4>Ticket submited</h4><p>Ticked id is <?= $tid ?></p>
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