<?php
require_once "includes/init.php";
define("PAGE","settings");

if(!logged_in()){
    Helper::redirect("../login");
}

// redirect if KYC is is uploaded or rejected;
$kyc = new Kyc($kon, $email);
if($kyc->shouldUploadKYC() ){
    Helper::redirect('kyc');
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
<div class="row justify-content-center">
  <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="site-card">
      <div class="site-card-header">
        <h3 class="title">KYC</h3>
      </div>

      <div class="site-card-body">
        <?= 'Your KYC document is '.$kyc->status() ?>
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