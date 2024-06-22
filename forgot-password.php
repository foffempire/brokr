<?php 
    require_once("user/includes/init.php");
    if(logged_in()){
        Helper::redirect("user/dashboard");
    }
    $account = new Account($kon);

    if(isset($_POST['login'])){
        $email = Sanitizer::sanitizeEmail($_POST['email']);
        $pw = Sanitizer::sanitizeInput($_POST['password']);

        $wasSuccessful = $account->login($email, $pw);

        if($wasSuccessful){
            // check if email is verified
            if($account->emailIsVerified($email)){
                $_SESSION['crypBroke'] = $email;
                setcookie("crypBroke", $email, time() + (86400 * 1), "/");          
                Helper::redirect("user/dashboard");
            }else{
                $fakeToken = Helper::randomString(35);
                Helper::redirect("email_confirmation?pass=$fakeToken&qm=$email");
            }
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
                                <!-- Email Address -->

                                <div class="single-field">
                                    <label class="box-label" for="email">Email</label>
                                    <input
                                        class="box-input"
                                        type="text"
                                        name="email"
                                        placeholder="Enter your email address"
                                        required
                                        value=""
                                    />
                                </div>


                                <button type="submit" class="site-btn grad-btn w-100">
                                    Email Password Reset Link
                                </button>
                            </form>

                            <div class="singnup-text">
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

