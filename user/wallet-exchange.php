<?php
require_once "includes/init.php";
define("PAGE","exchange");

if(!logged_in()){
    Helper::redirect("../login");
}

$error = '';
if(isset($_POST['exchange'])){
  $from = Sanitizer::sanitizeInput($_POST['from_wallet']);
  $to = Sanitizer::sanitizeInput($_POST['to_wallet']);
  $amount = Sanitizer::sanitizeInput($_POST['amount']);

  $currentProfit = $user->profit();
  $currentMain = $user->bal();

  if($from == $to){
    $error = "Exchange between the same account is not possible";
  }
  if($amount < 10){
    $error = "Minimum Exchange amount is 10 USD";
  }
  
  else{
    if($from == "main"){
      if($amount > $currentMain){
        $error = "Insufficient fund in your main account";
      }else{
        // debit main
        $done = $user->debitMainBal($amount);
        if($done){
          // credit Profit
          $credited = $user->creditProfitBal($amount);
          if($credited){
            Helper::redirect("wallet-exchange-success");
          }
        }        
      }
    }

    elseif($from == "profit"){
      if($amount > $currentProfit){
        $error = "Insufficient fund in your profit account";
      }else{
        // debit profit
        $done = $user->debitProfitBal($amount);
        if($done){
          // credit main
          $credited = $user->creditMainBal($amount);
          if($credited){
            Helper::redirect("wallet-exchange-success");
          }
        }  
      }
    }

    
  }
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
                                        <div class="row">
  <div class="col-xl-12">
    <div class="site-card">
      <div class="site-card-header">
        <h3 class="title">Wallet Exchange</h3>
      </div>
      <div class="site-card-body">
        <div class="progress-steps">
          <div class="single-step current">
            <div class="number">01</div>
            <div class="content">
              <h4>Wallet Details</h4>
              <p>Enter your Wallet details</p>
            </div>
          </div>
          <div class="single-step">
            <div class="number">02</div>
            <div class="content">
              <h4>Success</h4>
              <p>Successfully Exchanged</p>
            </div>
          </div>
        </div>
        <div class="progress-steps-form">
        <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
          <form action="" method="post">
            <div class="row">
              <div class="col-xl-4 col-md-12">
                <label for="exampleFormControlInput1" class="form-label"
                  >From Wallet:</label
                >
                <div class="input-group">
                  <select name="from_wallet" class="site-nice-select">
                    <option value="main">
                      Main Wallet (<?= number_format($user->bal(),2) ?> USD )
                    </option>
                    <option selected value="profit">
                      Profit Wallet (<?= number_format($user->profit(),2) ?> USD
                      )
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-xl-4 col-md-12">
                <label for="exampleFormControlInput1" class="form-label"
                  >Enter Amount:</label
                >
                <div class="input-group">
                  <input
                    type="text"
                    name="amount"
                    class="form-control"
                    oninput="this.value = validateDouble(this.value)"
                    aria-label="Amount"
                    id="amount"
                    aria-describedby="basic-addon1"
                  />
                  <span class="input-group-text" id="basic-addon1">USD</span>
                </div>
                <div class="input-info-text charge"></div>
              </div>

              <div class="col-xl-4 col-md-12">
                <label for="exampleFormControlInput1" class="form-label"
                  >To Wallet:</label
                >
                <div class="input-group">
                  <select name="to_wallet" class="site-nice-select">
                    <option selected value="main">
                      Main Wallet (<?= number_format($user->bal(),2) ?> USD )
                    </option>
                    <option value="profit">
                      Profit Wallet (<?= number_format($user->profit(),2) ?> USD
                      )
                    </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="transaction-list table-responsive d-none">
              <div class="user-panel-title">
                <h3>Review Details:</h3>
              </div>
              <table class="table">
                <tbody>
                  <tr>
                    <td><strong>Amount</strong></td>
                    <td>
                      <span class="amount"></span>
                      <span class="currency"></span>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Charge</strong></td>
                    <td class="charge2"></td>
                  </tr>
                  <tr>
                    <td><strong>Total</strong></td>
                    <td class="total"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="buttons">
              <button type="submit" name="exchange" class="site-btn blue-btn">
                Proceed to Exchange<i class="anticon anticon-double-right"></i>
              </button>
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

<script>
  const input = document.getElementById("amount");
  const amount = document.querySelector(".amount");
  const charge2 = document.querySelector(".charge2");
  const currency = document.querySelector(".currency");
  const total = document.querySelector(".total");
  const dDiv = document.querySelector(".transaction-list");

  input.oninput = ()=>{
    dDiv.classList.remove("d-none")
    amount.textContent = input.value
    charge2.textContent = 0
    currency.textContent = "USD"
    total.textContent = input.value
  }
  </script>
<?php require_once('includes/components/footer.php') ?>
