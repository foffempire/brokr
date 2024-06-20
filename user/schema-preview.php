<?php
require_once "includes/init.php";
define("PAGE","plans");

if(!logged_in()){
    Helper::redirect("../login");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    Helper::redirect('schemas');
}
$error='';
// get schemas
$qr = $kon->prepare("SELECT * FROM plans WHERE id = :id ");
$qr->bindParam("id", $id);
$qr->execute();
$row=$qr->fetch(PDO::FETCH_ASSOC);
$plan = $row['name'];
$min = $row['min'];
$max = $row['max'];
$rate = $row['percentage'];
$main = $user->bal();
$profit = $user->profit();

$invest = new Investment($kon);


if(isset($_POST['submit'])){
    $amount = Sanitizer::sanitizeInput($_POST['invest_amount']);
    $wallet = Sanitizer::sanitizeInput($_POST['wallet']);

    if($amount < $min || $amount > $max){
        $error = "Minimum amount is $min USD and maximum amount is $max USD";
    }else{
        if($wallet == "main"){
            if($main < $amount){
                $error = "Insufficient fund in your main account";
            }else{
                // insert into invesments and debit account
                $status = "Running";
                $insert = $invest->mainInvest($email, $amount, $plan, $wallet, $status, $rate);
                if($insert){
                    Helper::redirect("investment_success");
                }
            }
        }
        elseif($wallet == "profit"){
            if($profit < $amount){
                $error = "Insufficient fund in your profit account";
            }else{
                // insert into invesments and debit account
                $status = "Running";
                $insert = $invest->profitInvest($email, $amount, $plan, $wallet, $status, $rate);
                if($insert){
                    Helper::redirect("investment_success");
                }                
            }
        }else{
            // insert into investments
            $status = "pending";
            $insert = $invest->addInvestment($email, $amount, $plan, $wallet, $status, $rate);
            if($insert){
                Helper::redirect("deposit");
            }
        }
    }

}


// query investments
$st = "completed";
$stmt = $kon->prepare("SELECT SUM(amount) AS total_invest FROM investments WHERE email = :email AND status = :st ");
$stmt->bindParam("email", $email);
$stmt->bindParam("st", $st);
$stmt->execute();
$rowTotal = $stmt->fetch(PDO::FETCH_ASSOC);
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
                        <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Review and Confirm Investment</h3>
                </div>
                <div class="site-card-body">
                <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
                    <form
                        action=""
                        method="post"
                    >
                        <div class="progress-steps-form">
                        <div class="transaction-list table-responsive">
                            <table class="table preview-table">
                            <tbody>
                                <tr>
                                <td><strong>Select Schema:</strong></td>
                                <td>
                                    <div class="input-group mb-0">
                                    <select
                                        class="site-nice-select"
                                        aria-label="Default select example"
                                        id="select-schema"
                                        name="schema_id"
                                        required
                                    >
                                        <option value="<?= $row['id'] ?>" selected><?= $plan ?></option>
                                    </select>
                                    </div>
                                </td>
                                </tr>

                                <tr>
                                <td><strong>Profit Holiday:</strong></td>
                                <td id="holiday"><?= $row['note'] == "No Profit Holidays" ? "No" : "Yes" ?></td>
                                </tr>

                                <tr>
                                <td><strong>Amount:</strong></td>
                                <td id="amount">Minimum <?= $min ?> USD - Maximum <?= $max ?> USD</td>
                                </tr>

                                <tr>
                                <td><strong>Enter Amount:</strong></td>
                                <td>
                                    <div class="input-group mb-0">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter Amount"
                                        oninput="this.value = validateDouble(this.value)"
                                        aria-label="Amount"
                                        name="invest_amount"
                                        id="enter-amount"
                                        aria-describedby="basic-addon1"
                                        required
                                    />
                                    <span class="input-group-text" id="basic-addon1">USD</span>
                                    </div>
                                </td>
                                </tr>

                                <tr>
                                <td><strong>Select Wallet:</strong></td>
                                <td>
                                    <div class="input-group mb-0">
                                    <select
                                        class="site-nice-select"
                                        aria-label="Default select example"
                                        name="wallet"
                                        required
                                        id="selectWallet"
                                    >
                                        <option value="main">Main Wallet ( <?= number_format($user->bal(),2) ?> USD )</option>
                                        <option value="profit">Profit Wallet ( <?= number_format($user->profit(),2) ?> USD)</option>
                                        <option value="gateway">Direct Gateway</option>
                                    </select>
                                    </div>
                                </td>
                                </tr>

                                <tr class="gatewaySelect"></tr>

                                <tr>
                                <td colspan="2">
                                    <div class="row manual-row"></div>
                                </td>
                                </tr>

                                <tr>
                                <td><strong>Return of Interest:</strong></td>
                                <td id="return-interest"><?= $rate ?>% (Daily)</td>
                                </tr>
                                <tr>
                                <td><strong>Number of Period:</strong></td>
                                <td id="number-period">3 Times</td>
                                </tr>
                                <tr>
                                <td><strong>Capital Back:</strong></td>
                                <td id="capital_back">Yes</td>
                                </tr>
                                <tr>
                                <td><strong>Total Investment Amount:</strong></td>
                                <td><span id="total-amount"> <?= $rowTotal['total_invest'] ?></span> USD</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="button">
                            <button type="submit" name="submit" class="site-btn primary-btn me-3">
                            <i class="anticon anticon-check"></i>Invest Now
                            </button>
                            <a href="./schemas" class="site-btn black-btn">
                            <i class="anticon anticon-stop"></i>Cancel
                            </a>
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