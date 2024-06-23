<?php
require_once "includes/init.php";
define("PAGE","withdraw");

if(!logged_in()){
    Helper::redirect("../login");
}

$error = "";

if(isset($_POST['withdraw'])){
    $gateway = Sanitizer::sanitizeInput($_POST['gateway']);
    $address = Sanitizer::sanitizeInput($_POST['wallet_address']);
    $amount = Sanitizer::sanitizeInput($_POST['amount']);

    if($gateway ==''){
        $error = "Select a payment method";
    }
    elseif(strlen($address) < 10){
        $error = "Enter a valid wallet address";
    }
    elseif(empty($amount) || $amount < 100){
        $error = "Minimum amount is 100 USD";
    }
    elseif(!is_numeric($amount)){
      $error = "Enter a valid amount";
    }
    elseif($amount > $user->bal()){
      $error = "Insufficient fund in your account";
    }
    
    
    else{
        $transaction = new Transaction($kon);
        $done = $transaction->addwithdrawal($email, $gateway, $amount, $address, "Pending");
        if($done){
            Helper::redirect("withdraw_success");
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
                <h3 class="title">Withdraw</h3>
            </div>
            <div class="site-card-body">
            <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
                <form action="" method="post">
                    <div class="progress-steps-form">
                    <div class="input-group">
                    <label for="exampleFormControlInput1" class="form-label">Payment method</label>
          <select
            name="gateway"
            id="gatewaySelect"
            class="site-nice-select"
          >
            <option value="">--Select Gateway--</option>
            <option value="BTC">Bitcoin</option>
            <option value="Ethereum">Ethereum</option>
          </select>
        </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Enter wallet address</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="wallet_address"
                                        value="<?= @$address ?>"
                                        placeholder="Wallet address"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Amount</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="amount"
                                        value="<?= @$amount ?>"
                                        placeholder="Amount"
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <button type="submit" name="withdraw" class="site-btn blue-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

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

