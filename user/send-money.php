<?php
require_once "includes/init.php";
define("PAGE","send");

if(!logged_in()){
    Helper::redirect("../login");
}
$error='';

if(isset($_POST['submit'])){
    $receiver = Sanitizer::sanitizeInput($_POST['email']);
    $amount = Sanitizer::sanitizeInput($_POST['amount']);
    $note = Sanitizer::sanitizeInput($_POST['note']);

    // query email
    $qr = $kon->prepare("SELECT * FROM users WHERE email = :rec");
    $qr->bindParam(":rec", $receiver);
    $qr->execute();
    if(empty($receiver)){
        $error = "Enter receiver email";        
    }else if($amount < 10 || $amount > 100000){
        $error = "Minimum 10 USD and Maximum 100000 USD";
    }elseif ($amount > $user->bal()) {
        $error = "Insufficient fund in your main account";
    }elseif ($qr->rowCount() < 1) {
       $error = "User not found!";
    }elseif ($receiver == $email) {
        $error = "You cannot send money to yourself!";
    }
    else{
        // debit sender
        $debit = $user->debitMainBal($amount);
        if($debit){
            // add to database
            $date = Helper::dateTime();
            $tid = strtoupper(Helper::randomString(10));
            $query = $kon->prepare("INSERT INTO send_money(sender, receiver, amount, note, tid, date_added) VALUES(:sender, :rec, :amt, :note, :tid, :dt)");
            $query->bindParam(":sender", $email);
            $query->bindParam(":rec", $receiver);
            $query->bindParam(":amt", $amount);
            $query->bindParam(":note", $note);
            $query->bindParam(":tid", $tid);
            $query->bindParam(":dt", $date);
            $done = $query->execute();
            if($done){
                // credit receiver
                $stmt = $kon->prepare("SELECT * FROM users WHERE email = :rec ");
                $stmt->bindParam(":rec", $receiver);
                $stmt->execute();
                $recRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $receiverCurrentBal = $recRow['bal'];

                $newBal = $receiverCurrentBal + $amount;
                $rrr = $kon->prepare("UPDATE users SET bal = :bal WHERE email = :rec ");
                $rrr->bindParam(":bal", $newBal);
                $rrr->bindParam(":rec", $receiver);
                $credited = $rrr->execute();
                if($credited){
                    Helper::redirect("send-money-success");
                }
                    
            }
        }else{
            $error = "Something went wrong, try again!";
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
                    <h3 class="title">Send Money</h3>
                    <div class="card-header-links">
                        <a href="./send-money-log"
                           class="card-header-link">SEND MONEY LOG</a>
                    </div>
                </div>
                <div class="site-card-body">
                    <div class="progress-steps">
                        <div class="single-step current">
                            <div class="number">01</div>
                            <div class="content">
                                <h4>Payment Details</h4>
                                <p>Enter your Payment details</p>
                            </div>
                        </div>
                        <div class="single-step ">
                            <div class="number">02</div>
                            <div class="content">
                                <h4>Success</h4>
                                <p>Successfully Payment</p>
                            </div>
                        </div>
                    </div>
                    
    <div class="progress-steps-form">
        <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                <label for="exampleFormControlInput1" class="form-label"
                    >User Email</label
                >
                <div class="input-group">
                    <input
                    type="email"
                    name="email"
                    value="<?= @$receiver ?>"
                    required
                    class="form-control userCheck"
                    placeholder="User Email"
                    />
                </div>
                <div class="input-info-text notifyUser"></div>
                </div>
                <div class="col-xl-6 col-md-12">
                <label for="exampleFormControlInput1" class="form-label"
                    >Enter Amount</label
                >
                <div class="input-group">
                    <input
                    type="text"
                    class="form-control sendAmount"
                    name="amount"
                    value="<?= @$amount ?>"
                    required
                    placeholder="Enter Amount"
                    aria-label="Amount"
                    oninput="this.value = validateDouble(this.value)"
                    aria-describedby="basic-addon1"
                    />
                    <span class="input-group-text" id="basic-addon1">USD</span>
                </div>
                </div>
                <div class="col-xl-12 col-md-12 mt-3">
                <label for="exampleFormControlInput1" class="form-label"
                    >Send Money Note (Optional)</label
                >
                <div class="input-group">
                    <textarea
                    class="form-control-textarea"
                    placeholder="Send Money Note"
                    name="note"
                    ><?= @$note ?></textarea>
                </div>
                </div>
            </div>
            <div class="transaction-list table-responsive d-none">
                <div class="user-panel-title">
                <h3>Send Money Details</h3>
                </div>
                <table class="table">
                <tbody>
                    <tr>
                    <td><strong>Payment Amount</strong></td>
                    <td><span class="previewAmount"></span> USD</td>
                    </tr>
                    <tr>
                    <td><strong>Charge</strong></td>
                    <td><span class="previewCharge"></span> USD</td>
                    </tr>
                    <tr>
                    <td><strong>User Email</strong></td>
                    <td class="userEmail"></td>
                    </tr>
                </tbody>
                </table>
            </div>

            <div class="buttons">
                <button type="submit" name="submit" class="site-btn blue-btn">
                Send Money<i class="anticon anticon-double-right"></i>
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
  const userCheck = document.querySelector(".userCheck");
  const sendAmount = document.querySelector(".sendAmount");
  const previewAmount = document.querySelector(".previewAmount");
  const previewCharge = document.querySelector(".previewCharge");
  const userEmail = document.querySelector(".userEmail");
  const dDiv = document.querySelector(".transaction-list");

  sendAmount.oninput = ()=>{
    dDiv.classList.remove("d-none")
    userEmail.textContent = userCheck.value
    previewAmount.textContent = sendAmount.value
    previewCharge.textContent = 0
  }
  </script>

<?php require_once('includes/components/footer.php') ?>