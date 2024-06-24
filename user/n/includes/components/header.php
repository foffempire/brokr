<?php 
require_once("includes/init.php"); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title><?= Helper::site_name() .' | '. TITLE ?></title>
</head>
<body>
    <!-- header start -->
    <div class="header my-primary-bg text-light">
        <div class="header-top">
            <button class="hamburger"> <i class="fas fa-bars"></i> </button>
            <div class="header-menu">
                <a href="logout"><i class="fas fa-power-off"></i></a>
                <div class="sub-menu hide-it">
                    <a href="logout"><li>Logout</li></a>
                </div>
            </div>
        </div>
        <div class="header-body">
            <div class="welcome"> Welcome back, Admin</div>
            <span>[online]</span>
        </div>
    </div>
    <!-- header end -->

    <!-- side menu start -->
    <div class="sideMenu side-menu">
        <div class="logo"><img src="./assets/img/logo.png" width="120"></div>
        <div class="side-menu-content">
            <div class="user-info">
                <img src="./assets/img/user.jpg" >
                <p>Admin</p>
            </div>
            <a href="dashboard">
                <div class="menu-item"><i class="fas fa-users"></i> Users</div>
            </a>
            <a href="add_wallet">
                <div class="menu-item"><i class="fab fa-bitcoin"></i> Wallet Address</div>
            </a>
            <a href="invest?query=pending">
                <div class="menu-item"><i class="fas fa-briefcase"></i> Investments</div>
            </a>
            <a href="withdraw?query=pending">
                <div class="menu-item"><i class="fas fa-money-bill"></i> Withdrawals</div>
            </a>
            <a href="deposit">
                <div class="menu-item"><i class="fab fa-bitcoin"></i> Deposit</div>
            </a>
            <a href="kyc">
                <div class="menu-item"><i class="fas fa-user"></i> KYC</div>
            </a>
            
            <div class="copyright">
                &copy; <?= date("Y").' '. Helper::site_name() ?>
            </div>
        </div>
    </div>
    <div class="side-menu-bg"></div>
    <!-- side menu end -->