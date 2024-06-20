<?php
require_once "includes/init.php";
define("PAGE","rank");

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
                    <h3 class="title">All The Badges</h3>
                </div>
                <div class="site-card-body">
                    <div class="row justify-content-center">
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-badge ">
                                    <div class="badge">
                                        <div class="img"><img src="../assets/global/images/sCQgIyl0OKzFiO73nmWF.svg" alt=""></div>
                                    </div>
                                    <div class="content">
                                        <h3 class="title">TFx Member</h3>
                                        <p class="description">By signing up to the account</p>
                                    </div>
                                </div>
                            </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-badge  locked ">
                                    <div class="badge">
                                        <div class="img"><img src="../assets/global/images/TQDUvbD48kmhmV9qifzh.svg" alt=""></div>
                                    </div>
                                    <div class="content">
                                        <h3 class="title">TFx Leader</h3>
                                        <p class="description">By earning $1000 from the site</p>
                                    </div>
                                </div>
                            </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-badge  locked ">
                                    <div class="badge">
                                        <div class="img"><img src="../assets/global/images/hGHllGGCIYfpx5Z2VKrW.svg" alt=""></div>
                                    </div>
                                    <div class="content">
                                        <h3 class="title">TFx Captain</h3>
                                        <p class="description">By earning $5000 from the site</p>
                                    </div>
                                </div>
                            </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="single-badge  locked ">
                                    <div class="badge">
                                        <div class="img"><img src="../assets/global/images/SaNfYL7WD2pzAAME8Sqb.svg" alt=""></div>
                                    </div>
                                    <div class="content">
                                        <h3 class="title">TFx Master</h3>
                                        <p class="description">By earning $10000 from the site</p>
                                    </div>
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