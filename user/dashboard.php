<?php
require_once "includes/init.php";
define("PAGE","dashboard");

if(!logged_in()){
    Helper::redirect("../login");
}

if(isset($_GET['updt'])){
    $bonusAdded = $user->updateBonusAlert();
    if($bonusAdded){
        Helper::redirect("dashboard");
    }
}

// recent transaction
$qr = $kon->prepare("SELECT * FROM transactions WHERE email = :em ORDER BY id DESC LIMIT 3");
$qr->bindParam("em", $email);
$qr->execute();
$rows=$qr->fetchAll(PDO::FETCH_ASSOC);
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
                    <div id="cr-widget-marquee"
        data-coins="bitcoin,ethereum,tether,ripple,cardano"
        data-theme="dark"
        data-show-symbol="true"
        data-show-icon="true"
        data-show-period-change="true"
        data-period-change="24H"
        data-api-url="https://api.cryptorank.io/v0"
      >
        <a href="https://cryptorank.io">Coins by Cryptorank</a>
        <script src="https://cryptorank.io/widget/marquee.js"></script>
      </div>

    
    <div class="row">
    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="user-ranking" >
            <h4>Level 1</h4>
            <p>TFx Member</p>
            <div class="rank" data-bs-toggle="tooltip" data-bs-placement="top" title="By signing up to the account">
                <img src="../assets/global/images/sCQgIyl0OKzFiO73nmWF.svg" alt="">
            </div>
        </div>
    </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">Referral URL</h3>
                </div>
                <div class="site-card-body">
                    <div class="referral-link">
                        <div class="referral-link-form">
                            <input type="text" value="<?= Helper::referral($user->unik()) ?>" id="refLink"/>
                            <button type="submit" onclick="copyRef()">
                                <i class="anticon anticon-copy"></i>
                                <span id="copy">Copy Url</span>
                                <input id="copied" hidden value="Copied">
                            </button>
                        </div>
                        <p class="referral-joined">
                        <?= $user->countReferral() ?> person(s) joined using this URL
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
</div>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div id="tradingview_80af3"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text"> </span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "width": "100%" ,
  "height": 500,
  "symbol": "COINBASE:BTCUSD",
  "interval": "D",
  "timezone": "Etc/UTC",
  "theme": "dark",
  "style": "1",
  "locale": "en",
  "enable_publishing": false,
  "allow_symbol_change": true,
  "container_id": "tradingview_80af3"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->

    
    <div class="row user-cards">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-inbox"></i></div>
            <div class="content">
                <h4><span class="count">1</span></h4>
                <p>All Transactions</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-file-add"></i></div>
            <div class="content">
                <h4><b>$</b><span class="count">0</span></h4>
                <p>Total Profit</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-check-square"></i></div>
            <div class="content">
                <h4><b>$</b><span class="count">0</span></h4>
                <p>Total Investment</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-credit-card"></i></div>
            <div class="content">
                <h4><b>$</b><span class="count"><?= $user->profit() ?></span></h4>
                <p>Bonus Profit</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-money-collect"></i></div>
            <div class="content">
                <h4><b>$</b><span class="count">0</span></h4>
                <p>Total Withdrawal</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-gift"></i></div>
            <div class="content">
                <h4><b>$</b><span class="count"><?= $user->countReferral() ?></span>
                </h4>
                <p>Referral Bonus</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
       
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-inbox"></i></div>
            <div class="content">
                <h4 class="count"><?= $user->countReferral() ?></h4>
                <p>Total Referral</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="single">
            <div class="icon"><i class="anticon anticon-radar-chart"></i></div>
            <div class="content">
                <h4 class="count">1</h4>
                <p>Rank Achieved</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
        
    </div>
</div>

<div style="height:500px">
    <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
  {
  "width": "100%",
  "height": "100%",
  "defaultColumn": "overview",
  "screener_type": "crypto_mkt",
  "displayCurrency": "USD",
  "colorTheme": "dark",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
</div>

    
    <div class="row">
    <div class="col-xl-12">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">Recent Transactions</h3>
            </div>
            <div class="site-card-body table-responsive">
                <div class="site-datatable">
                    <table class="display data-table">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Transactions ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Status</th>
                            <th>Gateway</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr>
                                <td>
                                    <div class="table-description">
                                        <div class="icon">
                                            <i icon-name="backpack
                                         ">
                                            </i>
                                        </div>


                                        <div class="description">
                                            <strong><?= $row['status'] ?></strong>
                                            <div class="date"><?= $row['datetime'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><strong><?= $row['transaction_id'] ?></strong></td>
                                <td>
                                    <div
                                        class="site-badge primary-bg"><?= $row['type'] ?></div>
                                </td>

                                <td><strong
                                        class="green-color">+<?= $row['amount'] ?> USD</strong>
                                </td>
                                <td><strong><?= $row['fee'] ?> USD</strong></td>
                                <td>
                                    <div class="site-badge success"><?= $row['status'] ?></div>
                                                                    </td>
                                <td><strong><?= $row['gateway'] ?></strong></td>
                            </tr>
                            <?php } ?>
                        

                                                </tbody>
                    </table>
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
     <?= $user->bonusalert() ?>     
    <!-- /Automatic Popup End -->
</div>
<!--/Full Layout-->


<script>
        function copyRef() {
            /* Get the text field */
            var copyApi = document.getElementById("refLink");
            /* Select the text field */
            copyApi.select();
            copyApi.setSelectionRange(0, 999999999); /* For mobile devices */
            /* Copy the text inside the text field */
            document.execCommand('copy');
            $('#copy').text($('#copied').val())

        }
</script>


<?php require_once('includes/components/footer.php') ?>