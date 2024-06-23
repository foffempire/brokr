<?php
require_once "includes/init.php";
define("PAGE","deposit");

if(!logged_in()){
    Helper::redirect("../login");
}

$error = "";

if(isset($_POST['deposit'])){
    $gateway = Sanitizer::sanitizeInput($_POST['gateway']);
    $amount = Sanitizer::sanitizeInput($_POST['amount']);
    $type = "Deposit";
    $fee = 0;
    $status = "Pending";
    
    $image = $_FILES['image'];
    $target_dir = "./images/deposit/";
    $imageFileType = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    $imgName = $gateway.time().'.'.$imageFileType;
    $target_file = $target_dir . $imgName;


    $uploadOk = 1;
    $check = getimagesize($image["tmp_name"]);
    if($check == false) {
        $error = "File is not an image";
        $uploadOk = 0;
    }

    // Check file size
    if ($image["size"] > 2000000) {
    $error = "File is too large";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error = "Only JPG, JPEG, PNG & GIF files are allowed";
    $uploadOk = 0;
    }

    if (!$uploadOk == 0) {
        if(empty($gateway)){
            $error = "Select a payment method";
        }elseif(empty($amount) || $amount < 100){
            $error = "Minimum deposit amount is 100 USD";
        }elseif(!is_numeric($amount)){
          $error = "Enter a valid amount";
        }
        else{
            if(move_uploaded_file($image["tmp_name"], $target_file)) {
              $transaction = new Transaction($kon);
                $done = $transaction->addDeposit($email, $type, $amount, $fee, $status, $gateway, $imgName);
                if($done){
                    Helper::redirect("deposit_success");
                }else{
                    $error = "Failed! Try again";
                }
            }
        }
    }
}



$beeteecee = 'btc';
$bee = $kon->prepare("SELECT * FROM wallets WHERE wallet_type = :btc ");
$bee->bindParam(":btc", $beeteecee);
$bee->execute();
$rbee = $bee->fetch(PDO::FETCH_ASSOC);

$eeeth = 'eth';
$ethe = $kon->prepare("SELECT * FROM wallets WHERE wallet_type = :eth ");
$ethe->bindParam(":eth", $eeeth);
$ethe->execute();
$rethe = $ethe->fetch(PDO::FETCH_ASSOC);
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
                    <h3 class="title">Add Money</h3>
                    <div class="card-header-links">
                        <a href="./deposit-log"
                           class="card-header-link">Deposit History</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps">
                        <div class="single-step current">
                            <div class="number">01</div>
                            <div class="content">
                                <h4>Deposit Amount</h4>
                                <p>Enter your deposit details</p>
                            </div>
                        </div>
                        <div class="single-step ">
                            <div class="number">02</div>
                            <div class="content">
                                <h4>Success</h4>
                                <p>Success Your Deposit</p>
                            </div>
                        </div>
                    </div>
                    <div class="progress-steps-form">
                    <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xl-6 col-md-12 mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Payment Method:</label
        >
        <div class="input-group">
          <select
            name="gateway"
            id="gatewaySelect"
            class="site-nice-select"
          >
            <option selected disabled>--Select Gateway--</option>
            <option value="BTC">Bitcoin</option>
            <option value="Ethereum">Ethereum</option>
          </select>
        </div>
        <div class="input-info-text charge"></div>
      </div>
      <div class="col-xl-6 col-md-12">
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
            id="sendAmount"
            aria-describedby="basic-addon1"
          />
          <span class="input-group-text" id="basic-addon1">USD</span>
        </div>
        <div class="input-info-text min-max">Minimum deposit is 100 USD</div>
      </div>
    </div>

    <div class="row manual-row d-none" id="filediv">
      <div class="text-center py-3"><h5>Make payment to the address below</h5></div>
      <div class="text-center">
        <p class="btc text-center d-none" id="btc"><?= $rbee['wallet_address'] ?></p>
        <p class="eth text-center" id="eth"><?= $rethe['wallet_address'] ?></p>
      </div>
      <div class="my-3">
        <div class="wrap-custom-file">
          <input
            type="file"
            name="image"
            id="ticket-attach"
            accept=".gif, .jpg, .png"
            required
          />
          <label for="ticket-attach">
            <img
              class="upload-icon"
              src="../assets/global/images/upload.svg"
              alt=""
            />
            <span>Attach proof of payment</span>
          </label>
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
            <td><span class="amount previewAmount"></span> <span class="currency">USD</span></td>
          </tr>
          <tr>
            <td><strong>Charge</strong></td>
            <td class="charge2 previewCharge"></td>
          </tr>
          <tr>
            <td><strong>Payment Method</strong></td>
            <!-- <td id="logo"><img src="" class="payment-method" alt="" /></td> -->
             <td class="payment-method"></td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td class="total"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="buttons">
      <button type="submit" name="deposit" class="site-btn blue-btn">
        Proceed to Payment<i class="anticon anticon-double-right"></i>
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
    
</div>
<!--/Full Layout-->

<script>
const gatewaySelect = document.getElementById("gatewaySelect");
const sendAmount = document.getElementById("sendAmount");
const fileDiv = document.getElementById("filediv");
const eth = document.getElementById("eth");
const btc = document.getElementById("btc");
const previewAmount = document.querySelector(".previewAmount");
const previewCharge = document.querySelector(".previewCharge");
const previewMethod = document.querySelector(".payment-method");
const total = document.querySelector(".total");
const dDiv = document.querySelector(".transaction-list");

sendAmount.oninput = ()=>{
    if(gatewaySelect.value != ''){
      selectGateway()
        fileDiv.classList.remove("d-none")
        dDiv.classList.remove("d-none")

        previewAmount.textContent = sendAmount.value
        previewMethod.textContent = gatewaySelect.value
        previewCharge.textContent = "0 USD"
        total.textContent = sendAmount.value
    }
}

gatewaySelect.onchange = ()=>{
  selectGateway()
  previewMethod.textContent = gatewaySelect.value
}

function selectGateway(){
  if(gatewaySelect.value == 'BTC'){
            btc.classList.remove("d-none")
            eth.classList.add("d-none")
        }
        if(gatewaySelect.value == 'Ethereum'){
            btc.classList.add("d-none")
            eth.classList.remove("d-none")
        }
}
</script>

<?php require_once('includes/components/footer.php') ?>
