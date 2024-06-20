<?php
require_once "includes/init.php";
define("PAGE","settings");

if(!logged_in()){
    Helper::redirect("../login");
}
$error = '';
if(isset($_POST['updatePW'])){
    $opass = Sanitizer::sanitizeInput($_POST['opass']);
    $npass = Sanitizer::sanitizeInput($_POST['npass']);
    $cpass = Sanitizer::sanitizeInput($_POST['cpass']);

    if(empty($opass) || empty($npass) || empty($cpass)){
        $error = "All fields are required";
    }elseif(strlen($npass) < 6){
        $error = "Password must contain at least 6 characters";
    }elseif($npass !== $cpass){
        $error = "Password doesn't match";
    }elseif($opass !== $user->password()){
        $error = "Incorrect Password";
    }else{
        $done = $user->updatePassword($npass);
        if($done){
            echo "<script>alert('Password was updated successfully!')</script>";
        }else{
            $error = "Failed! Try again";
        }
    }
}
?>

<?php include('includes/components/header.php') ?>

    <!--Side Nav-->
    <?php include('includes/components/sidebar.php') ?>
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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Change Password</h3>
                    <div class="card-header-links">
                        <a href="./settings" class="card-header-link">Back</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps-form">
                    <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
                        <form method="post">                            
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <label for="exampleFormControlInput1"
                                           class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <input type="password" name="opass" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <label for="exampleFormControlInput1"
                                           class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="npass" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <label for="exampleFormControlInput1"
                                           class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="cpass" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-12">
                                    <button type="submit" name="updatePW" class="site-btn blue-btn">Change Password</button>
                                </div>
                            </div>
                        </form>
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