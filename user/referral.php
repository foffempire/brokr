<?php
require_once "includes/init.php";
define("PAGE","referral");

if(!logged_in()){
    Helper::redirect("../login");
}

// referral transaction
$type = "Referral";
$qr = $kon->prepare("SELECT * FROM transactions WHERE type = :typ AND email = :em ORDER BY id DESC LIMIT 3");
$qr->bindParam("em", $email);
$qr->bindParam("typ", $type);
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
                                        <div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="site-card">
      <div class="site-card-header">
        <h3 class="title">Referral URL and Tree</h3>
      </div>
      <div class="site-card-body">
        <div class="referral-link">
          <div class="referral-link-form">
            <input
              type="text"
              value="<?= Helper::referral($user->unik()) ?>"
              id="refLink"
            />
            <button type="submit" onclick="copyRef()">
              <i class="anticon anticon-copy"></i>
              <span id="copy">Copy Url</span>
              <input id="copied" hidden value="Copied" />
            </button>
          </div>
          <p class="referral-joined"><?= $user->countReferral() ?> person(s) joined using this URL</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xl-12">
    <div class="site-card">
      <div class="site-card-header">
        <h3 class="title">All Referral Logs</h3>
        <div class="card-header-links">
          <span class="card-header-link rounded-pill">
            Referral Profit: 0 USD</span
          >
        </div>
      </div>
      <div class="site-card-body table-responsive">
        <div class="site-tab-bars">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                href=""
                class="nav-link active"
                id="generalTarget-tab"
                data-bs-toggle="pill"
                data-bs-target="#generalTarget"
                type="button"
                role="tab"
                aria-controls="generalTarget"
                aria-selected="true"
                ><i icon-name="network"></i>General</a
              >
            </li>
          </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
          <div
            class="tab-pane fade show active"
            id="generalTarget"
            role="tabpanel"
            aria-labelledby="generalTarget-tab"
          >
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="site-datatable">
                  <div class="row table-responsive">
                    <div class="col-xl-12">
                      <table class="display data-table">
                        <thead>
                          <tr>
                            <th>Description</th>
                            <th>Transactions ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row) { ?>
                            <tr>
                                <td><?= $row['type'] ?></td>
                                <td><?= $row['transaction_id'] ?></td>
                                <td><?= $row['amount'] ?></td>
                                <td><?= $row['status'] ?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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