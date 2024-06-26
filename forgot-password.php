<?php 
    require_once("user/includes/init.php");
    require_once("includes/email/email.php");
    if(logged_in()){
        Helper::redirect("user/dashboard");
    }
    $account = new Account($kon);

    $error="";
    if(isset($_POST['forgot'])){
        $email = Sanitizer::sanitizeEmail($_POST['email']);
        $account = new Account($kon);
        if($account->email_exist($email)){
            // set new password
            $password = Helper::randomString(12);
            $updt = $kon->prepare("UPDATE users SET password = :pass WHERE email = :em");
            $updt->bindParam(":pass", $password);
            $updt->bindParam(":em", $email);
            $done = $updt->execute();
            if($done){
                // Email new password
                $logo = Helper::site_logo();
                $uza = new User($kon, $email);
                $firstname = $uza->firstname();
                $lastname = $uza->lastname();
                $subject = "New password";
                $html = "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email</title>
                </head>
                <body style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif;font-size: 16px;color: #474747;line-height:30px;'>

                    <div style='background-color: #6d08a8;height:10px;width:100%;'></div>
                    <div style='background-color: #ffffff;padding:10px 0;width:100%;display:flex;justify-content:center;'>
                        <img src='$logo' alt='logo' width='100'>
                    </div>
                    <div style='padding: 20px;'>
                        <div style='font-weight:600;font-size: 18px;margin-bottom: 30px;'>Verify Email Address</div>    

                        <div style='margin-bottom: 10px;'>Hello $firstname $lastname</div>
                        <div>
                        You have requested for a password reset. Here's your new temporary password.
                        <p>New password: $password </p>
                        <p>Login with your new temporary password and set a new password immediately. If you did not request for a password change, delete this mail and change your current password immediately.</p>
                        
                        </div>

                        <div style='margin-top: 10px;'>
                        Regards,
                        <p>Wealth Fusion Team</p>
                        </div>

                        
                    </div>
                    <div style='background-color: #6d08a8;height:10px;width:100%;'></div>
                </body>
                </html>";
                sendMail($email, $subject, $html);

                Helper::redirect('forgot-password-success');
            }
        }else{
            $error = "Email not found";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="keywords" content="<?= Helper::site_name() ?>">
    <meta name="description" content="<?= Helper::site_name() ?>">
    <link rel="canonical" href="./"/>
    <link rel="shortcut icon" href="assets/global/images/Z5TuPXphNN6rtz4h278X.png" type="image/x-icon"/>

    <link rel="icon" href="assets/global/images/Z5TuPXphNN6rtz4h278X.png" type="image/x-icon"/>
    <link rel="stylesheet" href="assets/global/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/vendor/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/animate.css"/>
    <link rel="stylesheet" href="assets/frontend/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/nice-select.css"/>
    <link rel="stylesheet" href="assets/global/css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/vendor/mckenziearts/laravel-notify/css/notify.css"/>        
    <link rel="stylesheet" href="assets/global/css/custom.css"/>
    <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css"/>
    <link rel="stylesheet" href="assets/frontend/css/aos.css"/>
    <link rel="stylesheet" href="assets/frontend/css/styles.css?"/>

    <style>
.site-head-tag {
	margin: 0;
  	padding: 0;
}

html, body {
  overflow-x: hidden;
}
    </style>

    <title><?= Helper::site_name() ?> - Forgot Password</title>
</head>
<body>
<script>
    var notify = {
        timeout: "5000",
    }
</script>

    <!-- Login Section -->
    <section class="section-style site-auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-8 col-md-12">
                    <div class="auth-content">
                        <div class="logo">
                            <a href="./"><img src="assets/global/images/hH42szx7wOd36BuyKWHJ.png" alt=""/></a>
                        </div>
                        <div class="title">
                            <h2> Password Reset</h2>
                            <p>Reset your Password</p>
                        </div>
                        
                        

                        <div class="site-auth-form">


                            <form method="POST" action="">
                            <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>

                                <div class="single-field <?= $hide ?>">
                                    <label class="box-label" for="email">Email</label>
                                    <input
                                        class="box-input"
                                        type="text"
                                        name="email"
                                        placeholder="Enter your email address"
                                        required
                                        value="<?= @$email ?>"
                                    />
                                </div>


                                <button type="submit" name="forgot" class="site-btn grad-btn w-100 <?= $hide ?>">
                                    Email Password Reset Link
                                </button>
                            </form>

                            <div class="singnup-text <?= $hide ?>">
                                <p>Already have an account? <a
                                        href="login">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

<script src="assets/global/js/jquery.min.js"></script>
<script src="assets/global/js/jquery-migrate.js"></script>

<script src="assets/frontend/js/bootstrap.bundle.min.js"></script>
<script src="assets/frontend/js/scrollUp.min.js"></script>

<script src="assets/frontend/js/owl.carousel.min.js"></script>
<script src="assets/global/js/waypoints.min.js"></script>
<script src="assets/frontend/js/jquery.counterup.min.js"></script>
<script src="assets/frontend/js/jquery.nice-select.min.js"></script>
<script src="assets/frontend/js/lucide.min.js"></script>
<script src="assets/frontend/js/magnific-popup.min.js"></script>
<script src="assets/frontend/js/aos.js"></script>
<script src="assets/global/js/datatables.min.js" type="text/javascript" charset="utf8"></script>
<script src="assets/frontend/js/main.js"></script>
<script src="assets/frontend/js/cookie.js"></script>
<script src="assets/global/js/custom.js"></script>
</body>
</html>

