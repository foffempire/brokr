<?php
require_once("includes/init.php");
include("email.php");

if(isset($_GET['signal']) && isset($_GET['uid'])){
    $email = $_GET['signal'];
    $uid = $_GET['uid'];
    $subject = "Pending Signal Clearance";
    $body = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signal</title>
</head>
<body style="padding: 0; margin: 0;">
    <div>
        <div style="background-color: #1B93CF;width: 100%; min-height: 100vh;">
            <div style="padding: 20px 0;display: flex; justify-content: center;align-items: center;">
                <img src="https://flipearners.com/assets/img/logo-light.png" alt="logo" width="200">
            </div>
            <div style="display: flex; justify-content: center;align-items: center; ">
                <div style="background-color: #fff; width: 100%; padding: 20px;border-radius: 20px;">
                    <h3 style="text-align: center;">
                        <p style="padding: 0; margin: 0;">SIGNAL FEE CLEARANCE PENDING </p>
                        <p style="padding: 0; margin: 0;">PLEASE CONTACT SUPPORT</p>
                    </h3>
                    <p style="padding: 30px 0;">
                        Your signal fee has not been cleared and currently at the point where trading can\'t continue, please contact support, clear the deficit for you to be able to regain full access on your personal trading account/portfolio.
                    </p>
                    <hr>
                    <div style="text-align: center;padding: 20px 0;">
                        contact support@flipearners.com
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    
    ';
    sendMail($email, $subject, $body);
    // Helper::redirect("userDetail?id=$uid");
}





if(isset($_GET['tradingcomm']) && isset($_GET['uid'])){
    $email = $_GET['signal'];
    $uid = $_GET['uid'];
    $subject = "Trading Commission";
    $body = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signal</title>
</head>
<body style="padding: 0; margin: 0;">
    <div>
        <div style="background-color: #1B93CF;width: 100%; min-height: 100vh;">
            <div style="padding: 20px 0;display: flex; justify-content: center;align-items: center;">
                <img src="https://flipearners.com/assets/img/logo-light.png" alt="logo" width="200">
            </div>
            <div style="display: flex; justify-content: center;align-items: center; ">
                <div style="background-color: #fff; width: 100%; padding: 20px;border-radius: 20px;">
                    <h3 style="text-align: center;">
                        <p style="padding: 0; margin: 0;">TRADING COMMISION PENDING </p>
                        <p style="padding: 0; margin: 0;">PLEASE CONTACT SUPPORT</p>
                    </h3>
                    <p style="padding: 30px 0;">
                        You\'re are required to pay a Trading Commission fee to be eligible to receive your commissions. Kindly contact support to clear up the fee and continue earning.
                    </p>
                    <hr>
                    <div style="text-align: center;padding: 20px 0;">
                        contact us support@flipearners.com
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    
    ';
    sendMail($email, $subject, $body);
    // Helper::redirect("userDetail?id=$uid");
}

?>