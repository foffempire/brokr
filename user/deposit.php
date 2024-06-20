<?php
require_once "includes/init.php";
define("PAGE","deposit");

if(!logged_in()){
    Helper::redirect("../login");
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
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-xl-6 col-md-12 mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Payment Method:</label
        >
        <div class="input-group">
          <select
            name="gateway_code"
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
            id="amount"
            aria-describedby="basic-addon1"
          />
          <span class="input-group-text" id="basic-addon1">USD</span>
        </div>
        <div class="input-info-text min-max"></div>
      </div>
    </div>

    <div class="row manual-row"></div>

    <div class="transaction-list table-responsive">
      <div class="user-panel-title">
        <h3>Review Details:</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td><strong>Amount</strong></td>
            <td><span class="amount"></span> <span class="currency"></span></td>
          </tr>
          <tr>
            <td><strong>Charge</strong></td>
            <td class="charge2"></td>
          </tr>
          <tr>
            <td><strong>Payment Method</strong></td>
            <td id="logo"><img src="" class="payment-method" alt="" /></td>
          </tr>
          <tr>
            <td><strong>Total</strong></td>
            <td class="total"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="buttons">
      <button type="submit" class="site-btn blue-btn">
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


    <!-- Automatic Popup -->
    
    <!-- /Automatic Popup End -->
</div>
<!--/Full Layout-->

 
<script>

        var globalData;
        var currency = "USD"
        $("#gatewaySelect").on('change',function (e) {
            "use strict"
            e.preventDefault();

            $('.manual-row').empty();

            var code = $(this).val()

            var url = 'https://texforex.com/user/deposit/gateway/:code';
            url = url.replace(':code', code);
            $.get(url, function (data) {


                globalData = data;

                $('.charge').text('Charge ' + data.charge + ' ' + (data.charge_type === 'percentage' ? ' % ' : currency))
                $('.min-max').text('Minimum ' + data.minimum_deposit + ' ' + currency + ' and ' + 'Maximum ' + data.maximum_deposit + ' ' + currency)

                $('#logo').html(`<img class="payment-method" src='${document.location.origin + '/assets/' + data.logo}'>`);

                var amount = $('#amount').val()

                if (Number(amount) > 0) {

                    $('.amount').text((Number(amount)))

                    var charge = data.charge_type === 'percentage' ? calPercentage(amount, data.charge) : data.charge
                    $('.charge2').text(charge + ' ' + currency)

                    $('.total').text((Number(amount) + Number(charge)) + ' ' + currency)
                }


                if (data.credentials !== undefined) {
                    $('.manual-row').append(data.credentials)
                    imagePreview()
                }


            });

            $('#amount').on('keyup',function (e) {
                "use strict"

                var amount = $(this).val()
                $('.amount').text((Number(amount)))

                $('.currency').text(currency)

                var charge = globalData.charge_type === 'percentage' ? calPercentage(amount, globalData.charge) : globalData.charge
                $('.charge2').text(charge + ' ' + currency)

                $('.total').text((Number(amount) + Number(charge)) + ' ' + currency)
            })


        });
    </script>
<?php require_once('includes/components/footer.php') ?>
