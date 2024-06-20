<?php
require_once "includes/init.php";
define("PAGE","support");

if(!logged_in()){
    Helper::redirect("../login");
}
$error = "";
if(isset($_POST['ticket'])){
    $title = Sanitizer::sanitizeInput($_POST['title']);
    $description = Sanitizer::sanitizeInput($_POST['message']);
    $date = Helper::dateTime();
    $tid = strtoupper(Helper::randomString(10));

    // if image was selected
    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
        $image = $_FILES['image'];
        $target_dir = "./images/tickets/";
        $imageFileType = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
        $imgName = $email.time().'.'.$imageFileType;
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
            if(empty($description) || empty($title)){
                $error = "Title and Description are required fields";
            }else{
                if(move_uploaded_file($image["tmp_name"], $target_file)) {
                    $qr = $kon->prepare("INSERT INTO support(ticketid, email, title, description, image, date_added) VALUES(:tid, :email, :title, :descr, :img, :dt)");
                    $qr->bindParam(":tid", $tid);
                    $qr->bindParam(":email", $email);
                    $qr->bindParam(":title", $title);
                    $qr->bindParam(":descr", $description);
                    $qr->bindParam(":img", $imgName);
                    $qr->bindParam(":dt", $date);
                    $done = $qr->execute();
                    if($done){
                        Helper::redirect("support_success?tid=$tid");
                    }else{
                        $error = "Failed! Try again";
                    }
                }
            }
        }
    }else{
        if(empty($description) || empty($title)){
            $error = "Title and Description are required fields";
        }else{
            $qr = $kon->prepare("INSERT INTO support(ticketid, email, title, description, date_added) VALUES(:tid, :email, :title, :descr, :dt)");
            $qr->bindParam(":tid", $tid);
            $qr->bindParam(":email", $email);
            $qr->bindParam(":title", $title);
            $qr->bindParam(":descr", $description);
            $qr->bindParam(":dt", $date);
            $done = $qr->execute();
            if($done){
                Helper::redirect("support_success?tid=$tid");
            }else{
                $error = "Failed! Try again";
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
                                <h3 class="title">Add New Support Ticket</h3>
                                <div class="card-header-links">
                                <a href="./support-ticket" class="card-header-link">All Tickets</a>
                                </div>
                            </div>
                            <div class="site-card-body">
                                <div class="progress-steps-form">
                                <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label"
                                        >Ticket Title</label
                                        >
                                        <div class="input-group">
                                        <input type="text" class="form-control" value="<?= @$title?>" name="title" required />
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                        <label for="exampleFormControlInput1" class="form-label"
                                        >Ticket Descriptions</label
                                        >
                                        <div class="input-group">
                                        <textarea
                                            class="form-control textarea"
                                            name="message"
                                            required
                                        ><?= @$description?></textarea>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="mb-3">
                                    <div class="wrap-custom-file">
                                        <input
                                        type="file"
                                        name="image"
                                        id="ticket-attach"
                                        accept=".gif, .jpg, .png"
                                        />
                                        <label for="ticket-attach">
                                        <img
                                            class="upload-icon"
                                            src="../assets/global/images/upload.svg"
                                            alt=""
                                        />
                                        <span>Attach Image</span>
                                        </label>
                                    </div>
                                    </div>
                                    <div class="buttons">
                                    <button type="submit" name="ticket" class="site-btn blue-btn">
                                        Add New Ticket<i class="anticon anticon-double-right"></i>
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
<?php require_once('includes/components/footer.php') ?>