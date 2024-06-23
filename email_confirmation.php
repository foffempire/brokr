<?php 
    require_once("user/includes/init.php");
    require_once("includes/email/email.php");
    if(logged_in()){
        Helper::redirect("user/dashboard");
    }

    if(isset($_GET['qm']) && isset($_GET['pass'])){
        $email=$_GET['qm'];
        $uza = new User($kon, $email);
        $firstname = $uza->firstname();
        $lastname = $uza->lastname();
        $prc = $uza->unik();

        // if email doesn't exist;
        if($email != $uza->email()){
            Helper::redirect("login");
            exit();
        }

        // if email doesn't exist;
        if($uza->isVerified()){
            Helper::redirect("login");
            exit();
        }
    }else{
        Helper::redirect("register");
    }

    $account = new Account($kon);

    if(isset($_POST['resend'])){
        // send mail
        $logo = Helper::site_logo();
        $link = Helper::site_url()."email-verify?email=$email&prc=$prc";
        $fakeToken = Helper::randomString(35);
        $subject = "Verify your email";
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

                  <div style='margin-bottom: 10px;'>Hi $firstname $lastname</div>
                  <div>Please click the button below to verify your email address.</div>

                  <div style='margin:30px 0;'>
                      <a href='$link' style='padding: 10px 25px; color: #ffffff;background-color: #ff0055;text-decoration: none;'>VERIFY EMAIL ADDRESS</a>
                  </div>
              </div>
              <div style='background-color: #6d08a8;height:10px;width:100%;'></div>
              <div style='padding: 20px;'>
                  <p>If you're having trouble clicking the 'Verify Email Address' button, copy abd paste the URL below into your web browser: <a href='$link'>$link</a></p>
              </div>
              <div style='background-color: #6d08a8;height:10px;width:100%;'></div>
          </body>
          </html>";
        sendMail($email, $subject, $html);

        // redirect
        Helper::redirect("email_confirmation?pass=$fakeToken&qm=$email");  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="icZS80o5U7GQcDQvrwVhBDHeTslfvCyYJwUlaH07">
    <meta name="keywords" content="<?= Helper::site_name() ?>">
    <meta name="description" content="<?= Helper::site_name() ?>">
    <link rel="canonical" href="login"/>
    <link rel="shortcut icon" href="assets/global/images/Z5TuPXphNN6rtz4h278X.png" type="image/x-icon"/>

    <link rel="icon" href="assets/global/images/Z5TuPXphNN6rtz4h278X.png" type="image/x-icon"/>
    <link rel="stylesheet" href="assets/global/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/vendor/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/animate.css"/>
    <link rel="stylesheet" href="assets/frontend/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="assets/frontend/css/nice-select.css"/>
    <link rel="stylesheet" href="assets/global/css/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="assets/vendor/mckenziearts/laravel-notify/css/notify.css"/>        <link rel="stylesheet" href="assets/global/css/custom.css"/>
    <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css"/>
            <link rel="stylesheet" href="assets/frontend/css/aos.css"/>
        <link rel="stylesheet" href="assets/frontend/css/styles.css"/>

    <style>
.site-head-tag {
	margin: 0;
  	padding: 0;
}

html, body {
  overflow-x: hidden;
}
    </style>

    <title><?= Helper::site_name() ?> -     Login
</title>


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
                            <p>Verify your email address by clicking on the link we just emailed to you.</p>
                        </div>

                        <?= $account->getError() ?>
                        

                        <div class="site-auth-form">
                            <form action="" method="POST" id="resend-btn" class="d-none">
                                <button type="submit" name="resend" class="site-btn grad-btn w-100"> Resend verification email </button>
                            </form>
                        </div>
                        <div id="resend-notify">Resend in <span id="time"></span></div>
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
<script src="assets/frontend/js/main830b.js?var=5"></script>
<script src="assets/frontend/js/cookie.js"></script>
<script src="assets/global/js/custom830b.js?var=5"></script>

<script>
    rbutton = document.querySelector('#resend-btn');
    rnotify = document.querySelector('#resend-notify');
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                rnotify.classList.add("d-none");
                rbutton.classList.remove("d-none");
            }
        }, 1000);
    }

    window.onload = function () {
        var oneMinutes = 60 * 1,
            display = document.querySelector('#time');
        startTimer(oneMinutes, display);
    };
    </script>

</body>
</html>

