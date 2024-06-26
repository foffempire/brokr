<?php 
    require_once("user/includes/init.php");
    if(logged_in()){
        Helper::redirect("user/dashboard");
    }
    $error = '';
    $account = new Account($kon);

    if(isset($_POST['login'])){
        $email = Sanitizer::sanitizeEmail($_POST['email']);
        $pw = Sanitizer::sanitizeInput($_POST['password']);

        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

            // Google secret API
            $secretAPIkey = '6LdxtAEqAAAAALuFIR_9alT40W1uaQ5A_wZiNoCS';

            // reCAPTCHA response verification
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);

            // Decode JSON data
            $response = json_decode($verifyResponse);
                if($response->success){
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
                } else {
                    $error = "Robot verification failed, please try again.";
                }       
        } else{ 
            $error = "Please check on the reCAPTCHA box.";
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

    <title><?= Helper::site_name() ?> - Login</title>
</head>
<body>
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
                            <h2> 👋 Welcome Back!</h2>
                            <p>Sign in to continue with <?= Helper::site_name() ?></p>
                        </div>

                        <?= $account->getError() ?>
                        <?= $error == '' ? '' : "<div class='alert alert-warning alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>

                        <div class="site-auth-form">
                            <form method="POST" action="">
                                <div class="single-field">
                                    <label class="box-label" for="email">Email Or Username</label>
                                    <input
                                        class="box-input"
                                        type="text"
                                        name="email"
                                        value="<?= @$email ?>"
                                        placeholder="Enter your email address"
                                        required
                                    />
                                </div>
                                <div class="single-field">
                                    <label class="box-label" for="password">Password</label>
                                    <div class="password">
                                        <input
                                            class="box-input"
                                            type="password"
                                            name="password"
                                            placeholder="Enter your password"
                                            required
                                        />
                                    </div>
                                </div>    
                                <div class="form-group mb-3">
                                    <div class="g-recaptcha" data-sitekey="6LdxtAEqAAAAAMCOCnGLAqC8qkO40VPG935ubxit"></div>
                                </div>                            
                                <div class="single-field">
                                    <input
                                        class="form-check-input check-input"
                                        type="checkbox"
                                        name="remember"
                                        id="flexCheckDefault"
                                    />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember me
                                    </label>

                                    <span class="forget-pass-text"><a
                                                href="forgot-password">Forget Password</a></span>
                                    </div>

                        
                                <button type="submit" name="login" class="site-btn grad-btn w-100">
                                    Account Login
                                </button>
                            </form>
                            <div class="singnup-text">
                                <p>
                                    Don&#039;t have an account?
                                    <a href="register">Signup for free</a>
                                </p>
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
<script src="https://www.google.com/recaptcha/api.js"></script>

</body>
</html>

