<?php
require_once "includes/init.php";
define("PAGE","settings");

if(!logged_in()){
    Helper::redirect("../login");
}

if(isset($_SESSION['profile_updated'])){
    echo "<script>alert('Profile updated Successfully!')</script>";
    unset($_SESSION['profile_updated']);
}

$error = "";

if(isset($_POST['profileUpdate'])){
    $firstname = Sanitizer::sanitizeInput($_POST['firstname']);
    $lastname = Sanitizer::sanitizeInput($_POST['lastname']);
    $gender = Sanitizer::sanitizeInput($_POST['gender']);
    $username = Sanitizer::sanitizeInput($_POST['username']);
    $dob = Sanitizer::sanitizeInput($_POST['dob']);
    $phone = Sanitizer::sanitizeInput($_POST['phone']);
    $city = Sanitizer::sanitizeInput($_POST['city']);
    $zipcode = Sanitizer::sanitizeInput($_POST['zipcode']);
    $address = Sanitizer::sanitizeInput($_POST['address']);
    $state = '';
    
    $image = $_FILES['image'];
    $target_dir = "./images/users/";
    $imageFileType = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    $imgName = $firstname.time().'.'.$imageFileType;
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
        if(empty($firstname) || empty($lastname) || empty($dob) || empty($phone) || empty($city) || empty($zipcode) || empty($address)){
            $error = "All fields are required";
        }else{
            if(move_uploaded_file($image["tmp_name"], $target_file)) {
                $done = $user->updateProfile($firstname, $lastname,$username, $phone, $imgName, $city, $state, $address, $gender, $dob, $zipcode);
                if($done){
                    $_SESSION['profile_updated'] = "";
                    Helper::redirect("settings");
                }else{
                    $error = "Failed! Try again";
                }
            }
        }
    }
}

?>
    <?php include('includes/components/header.php') ?>

    <!--Side Nav-->
    <?php include('includes/components/sidebar.php') ?>
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
                <h3 class="title">Profile Settings</h3>
            </div>
            <div class="site-card-body">
            <?= $error == '' ? '' : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>" ?>
                <form action="" method="post" enctype="multipart/form-data">                   
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="mb-3">
                                <div class="body-title">Avatar:</div>
                                <div class="wrap-custom-file">
                                    <input
                                        type="file"
                                        name="image"
                                        id="avatar"
                                        accept=".gif, .jpg, .png"
                                        required
                                    />


                                    <label for="avatar" >
                                        <img
                                            class="upload-icon"
                                            src="<?= $user->image() == null ? '../assets/global/images/upload.svg' : "images/users/".$user->image(); ?>"
                                            alt=""
                                        />
                                        <span>Update Avatar</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-steps-form">
                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="firstname"
                                        value="<?= $user->firstname() ?>"
                                        placeholder="First Name"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="lastname"
                                        value="<?= $user->lastname() ?>"
                                        placeholder="Last Name"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="username"
                                        value="<?= $user->username() ?>"
                                        placeholder="Username"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" id="kycTypeSelect" class="nice-select site-nice-select"
                                            required>
                                                                                    <option  value="male">male</option>
                                                                                    <option  value="female">female</option>
                                                                                    <option  value="other">other</option>
                                                                            </select>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <input
                                        type="date"
                                        name="dob"
                                        class="form-control"
                                        value="<?= $user->dob() ?>"
                                        placeholder="Date of Birth"
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">Email Address</label>
                                <div class="input-group">
                                    <input type="email" disabled class="form-control disabled"
                                           value="<?= $user->email() ?>" placeholder="Email Address"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="phone"
                                        value="<?= $user->phone() ?>"
                                        placeholder="Phone"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Country</label
                                >
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control disabled"
                                        value="<?= $user->country() ?>"
                                        placeholder="Country"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">City</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="city"
                                        value="<?= $user->city() ?>"
                                        placeholder="City"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Zip</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="zipcode"
                                        value="<?= $user->zip() ?>"
                                        placeholder="Zip"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1" class="form-label">Address</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="address"
                                        value="<?= $user->address() ?>"
                                        placeholder="Address"
                                    />
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <label for="exampleFormControlInput1"
                                       class="form-label">Joining Date</label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control disabled"
                                        value="<?= $user->regDate() ?>"
                                        placeholder="Joining Date"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <button type="submit" name="profileUpdate" class="site-btn blue-btn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

    
<div class="row">    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">KYC</h3>
            </div>
            <div class="site-card-body">
                <a href="./kyc" class="site-btn blue-btn">Upload KYC</a>
                <p class="mt-3"></p>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        
        
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">Change Password</h3>
            </div>
            <div class="site-card-body">
                <a href="./change-password" class="site-btn blue-btn">Change Password</a>
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

