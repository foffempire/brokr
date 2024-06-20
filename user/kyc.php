<?php
require_once "includes/init.php";
define("PAGE","settings");

if(!logged_in()){
    Helper::redirect("../login");
}
$error = "";
$kyc = new Kyc($kon, $email);
// redirect if KYC is approved or under review
if($kyc->hasDoneKYC()){
  if($kyc->status()=="Approved" || $kyc->status()=="Under review" ){
      Helper::redirect('kyc_stat');
  }
}


if(isset($_POST['updateKYC'])){
    $type = Sanitizer::sanitizeInput($_POST['kyc_type']);
    $fullnames = Sanitizer::sanitizeInput($_POST['fullnames']);

    
    $image = $_FILES['image'];
    $target_dir = "./images/kyc/";
    $imageFileType = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    $imgName = $fullnames.time().'.'.$imageFileType;
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
        if(empty($type)){
            $error = "Select verification type";
        }
        if(strlen($fullnames) < 6){
            $error = "Enter your full names";
        }
        else{
            if(move_uploaded_file($image["tmp_name"], $target_file)) {
                $done = $kyc->updateKYC($type, $fullnames,$imgName);
                if($done){
                    Helper::redirect("kyc_stat");
                }else{
                    $error = "Failed! Try again";
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
<div class="row justify-content-center">
  <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="site-card">
      <div class="site-card-header">
        <h3 class="title">KYC</h3>
      </div>

      <div class="site-card-body">
      <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>


        <form action="" method="post" enctype="multipart/form-data">
          <div class="col-xl-12 col-md-12">
            <div class="progress-steps-form">
              <label for="exampleFormControlInput1" class="form-label"
                >Verification Type</label
              >
              <div class="input-group">
                <select
                  name="kyc_type"
                  id="kycTypeSelect"
                  class="site-nice-select"
                  required
                >
                  <option selected disabled>----</option>
                  <option value="National ID">National ID Verification</option>
                  <option value="Drivers License">Drivers License</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-12">
            <div class="row kycData">
              <div class="col-xl-12 col-md-12">
                <div class="progress-steps-form">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Full Name</label
                  >
                  <div class="input-group">
                    <input
                      type="text"
                      name="fullnames"
                      class="form-control"
                      aria-label="Amount"
                      id="amount"
                      aria-describedby="basic-addon1"
                      required
                    />
                  </div>
                </div>
              </div>

              <div class="col-xl-12 col-md-12">
                <div class="body-title">Image Of ID</div>
                <div class="wrap-custom-file">
                  <input
                    type="file"
                    name="image"
                    id="2"
                    accept=".gif, .jpg, .png"
                    required=""
                  />
                  <label for="2">
                    <img
                      class="upload-icon"
                      src="../assets/global/images/upload.svg"
                      alt=""
                    />
                    <span>Select Image Of ID</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-12 col-md-12">
            <div class="row kycData"></div>
          </div>

          <button type="submit" name="updateKYC" class="site-btn blue-btn mt-3">
            Submit Now
          </button>
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