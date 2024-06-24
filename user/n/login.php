<?php 
    require_once("includes/init.php");
    if(logged_in()){
        Helper::redirect("dashboard");
    }
    $account = new Account($kon);

    if(isset($_POST['login'])){
        $email = Sanitizer::sanitizeEmail($_POST['email']);
        $pw = Sanitizer::sanitizeInput($_POST['password']);

        $wasSuccessful = $account->login($email, $pw);

        if($wasSuccessful){
            $_SESSION['adminLogin'] = $email;
            setcookie("adminLogin", $email, time() + (86400 * 1), "/");
            if(isset($_SESSION['location'])){
                helper::redirect($_SESSION['location']);
                unset($_SESSION['location']);
            }else{
                Helper::redirect("dashboard");
            }            
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?= Helper::site_name() ?></title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
    <section id="login">
        <div class="login-wrap">
            <div class="login-form">
                <div class="login-logo mb-5">
                    <img src="./assets/img/logo.png" width="200">
                </div>
                <?= $account->getError()  ?>
                <div><i class="fas fa-lock"></i><span class="text mx-2">Admin Area</span>  </div>
                <small>Log in securely into your account</small>
                <form action="" method="POST">
                <div class="form-group mb-3">
                    <label for="to">Username</label>
                    <input type="email" name="email" id="to" class="form-control form-control-sm" placeholder="Username">
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Enter your password">
                </div>
                <div class="mt-3">
                    <button type="submit" name="login" class="btn btn-secondary w-100 btn-sm">Sign in</button>
                </div>
                </form>
            </div>
            <div class="login-copy">
                <p>&copy; <?= date("Y").' '. Helper::site_name() ?>. All Rights Reserved</p>
                
            </div>
        </div>
    </section>

</body>
</html>