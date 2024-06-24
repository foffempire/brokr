<?php require_once("includes/init.php") ?>
<?php define("TITLE", "User Details"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }

    $wallet = new Wallet($kon);

    // if (isset($_POST['add_addr'])) {
    //     $addr = Sanitizer::sanitizeInput($_POST['addr']);
    //     $type = Sanitizer::sanitizeInput($_POST['coin']);
    //     $img = $_FILES['img'];

    //     if ($wallet->walletExist($type)) {
    //         $_SESSION['error'] = $type. " wallet already added";
    //     }else{
    //         $target_dir = "./assets/img/qrcode/";
    //         $target_file = $target_dir . basename($img["name"]);
    //         $uploadOk = 1;
    //         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    //         // Check if image file is a actual image or fake image
            
    //         $check = getimagesize($img["tmp_name"]);
    //         if($check !== false) {
    //         $uploadOk = 1;
    //         } else {
    //         $_SESSION['error'] = "File is not an image.";
    //         $uploadOk = 0;
    //         }

    //         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //         && $imageFileType != "gif" ) {
    //           $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //           $uploadOk = 0;
    //         }

    //         // Check if $uploadOk is set to 0 by an error
    //         if ($uploadOk == 0) {
    //           $_SESSION['error'] = "Sorry, your file was not uploaded.";
    //         // if everything is ok, try to upload file
    //         } else {
    //             $wasSuccessful = $wallet->addWallet($addr, $type, $img["name"]);
    //             if ($wasSuccessful) {
    //                 if (move_uploaded_file($img["tmp_name"], $target_file)) {
    //                 $_SESSION['success'] = "The file ". htmlspecialchars( basename( $img["name"])). " has been uploaded.";
    //               } else {
    //                 $_SESSION['error'] = "Sorry, there was an error uploading your file.";
    //               }
    //             }
    //         }
    //     }


        

    // }

    if (isset($_POST['add_addr'])) {
        $addr = Sanitizer::sanitizeInput($_POST['addr']);
        $type = Sanitizer::sanitizeInput($_POST['coin']);

        if ($wallet->walletExist($type)) {
            $_SESSION['error'] = $type. " wallet already added";
        }else{
            $wasSuccessful = $wallet->addWallet($addr, $type, "");
            if ($wasSuccessful) {
                $_SESSION['success'] = "Successful.";
                
            }
        }


        

    }
?>
<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">

        <div class="container">
        <h6>Your wallet</h6>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Coin Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $wallet->getWallets() ?>                            
                    </tbody>
                </table>
            </div>
        </div>


        <div class="container">
            <hr>
            <h6>Upload your wallet</h6>
            <?= Helper::alert() ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group my-3">
                    <label class="py-2" for="">Select Currency</label>
                    <select name="coin" class="form-control">
                        <?php $wallet->selectCoin() ?>
                    </select>
                </div>

                <div class="form-group my-3">
                    <label class="py-2" for="">Wallet Address</label>
                    <input type="text" name="addr" placeholder="address" class="form-control" required>
                </div>

                <!-- <div class="form-group my-3">
                    <label class="py-2" for="">Wallet Qr-code</label>
                    <input type="file" name="img" class="form-control" required>
                </div> -->

                <button type="submit" class="btn btn-primary" name="add_addr">SEND</button>
            </form>
        </div>
    </div>
</div>
    <!-- main content end -->


<?php require_once("includes/components/footer.php") ?>
