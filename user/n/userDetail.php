<?php require_once("includes/init.php") ?>
<?php define("TITLE", "User Details"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    $user = new Users($kon, $id);

    
    if(isset($_POST['updatebal'])){
        $amt = $_POST['amount'];
        $id = $_POST['id'];
        $done = $user->editBal($amt);
        if($done){
            Helper::redirect("userDetail?id=$id");
        }
    }
    if(isset($_POST['updateProfit'])){
        $profit = $_POST['profit'];
        $rate = $_POST['rate'];
        $id = $_POST['id'];
        $done = $user->editProfit($profit, $rate);
        if($done){
            Helper::redirect("userDetail?id=$id");
        }
    }
?>
<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">
        <div class="container">
            <h6><?= $user->fullname() ?></h6>
            <div class='container'>                    
                <div class='row'>
                    <div class="col-12 col-lg-6 pb-4">
                        <p><strong>First Name: </strong><?= $user->firstname() ?></p>
                        <p><strong>Middle Name: </strong><?= $user->middlename() ?></p>
                        <p><strong>Last Name: </strong><?= $user->lastname() ?></p>                        
                        <p><strong>Email: </strong><?= $user->email() ?></p>
                        <p><strong>Phone: </strong><?= $user->phone() ?></p>
                        <p><strong>Password: </strong><?= $user->password() ?></p>
                        <p><strong>Phone: </strong><?= $user->phone() ?></p>
                        <p><strong>Date of Birth: </strong><?= $user->dob() ?></p>
                        <p><strong>Country: </strong><?= $user->country() ?></p>
                        <p><strong>State: </strong><?= $user->state() ?></p>
                        <p><strong>City: </strong><?= $user->city() ?></p>
                        <p><strong>Address: </strong><?= $user->address() ?></p>
                        <p><strong>Date Joined: </strong> <?= $user->regDate() ?></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mb-4">
                        <p><strong>Current Balance: </strong>$<?= $user->bal() ?></p>
                        <p><strong>Profit: </strong>$<?= number_format($user->profit(),2) ?></p>
                        <!-- <p><strong>Profit Rate: </strong><?= $user->rate() ?>%</p> -->
                        </div>

                        <button class="btn btn-sm btn-primary open-edit-bal">Edit Balance</button>
                        <button class="btn btn-sm btn-warning open-edit-profit">Edit Profit</button>
                        <?php if ($user->isActive() == 1) { ?>
                            <a href="process?blockUser=<?= $id ?>">
                            <button class="btn btn-sm btn-secondary open-edit-bal" onclick="return confirm('Sure to block user?')" >Block User</button>
                        </a>
                        <?php }else{ ?>
                            <a href="process?unBlockUser=<?= $id ?>">
                                <button class="btn btn-sm btn-secondary open-edit-bal" onclick="return confirm('Sure to unblock user?')" >Unblock User</button>
                            </a>
                        <?php } ?>
                        <a href="process?delUser=<?= $id ?>">
                            <button class="btn btn-sm btn-danger open-edit-bal" onclick="return confirm('Sure to delete?')" >Delete User</button>
                        </a>
                        <br><br><br>
                        
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
    <!-- main content end -->
<style>
    .edit-user, .edit-profit{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        justify-content: center;
        padding-top: 100px;
        z-index: 4;
    }

    .edit-user::after, .edit-profit::after{
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        padding-top: 100px;
        background-color: black;
        z-index: 5;
        opacity: .8;
    }
    .edit-bal{
        position: relative;
        background-color: white;
        border-radius: 5px;
        padding: 20px;
        width: 300px;
        height: 300px;
        z-index: 6;
    }
    .edit-bal-btn, .edit-profit-btn{
        position: absolute;
        top: 10px;
        right: 10px;
        font-weight: bold;
        background-color: transparent;
        border: none;
    }
</style>


<div class="edit-user">
    <div class="edit-bal">
        <button class="edit-bal-btn">X</button>
        <h5 class='py-3'>Edit Balance</h5>
        <form action="" method="POST">
            <input type="number" name="amount" min="50" step="" placeholder="Amount" class="form-control" required>
            <input type="hidden" value="<?= $user->id() ?>" name="id">
            <button type="submit" name="updatebal" class="btn btn-primary btn-sm mt-3">Send</button>
        </form>
    </div>
</div>
<div class="edit-profit">
    <div class="edit-bal">
        <button class="edit-profit-btn">X</button>
        <h5 class='py-3'>Edit Profit</h5>
        <form action="" method="POST">
            <input type="number" name="profit" min="0" step="" placeholder="Profit" class="form-control mb-2" required>
            <input type="hidden" name="rate" value="10" min="0" step="0.01" placeholder="Profit Rate in %" class="form-control" required>
            <input type="hidden" value="<?= $user->id() ?>" name="id">
            <button type="submit" name="updateProfit" class="btn btn-primary btn-sm mt-3">Send</button>
        </form>
    </div>
</div>
<script>
    const editBtn = document.querySelector(".open-edit-bal");
    const closeBtn = document.querySelector(".edit-bal-btn");
    const editDiv = document.querySelector(".edit-user");
    editBtn.addEventListener("click", ()=>{
        editDiv.style.display = "flex";
    });
    closeBtn.addEventListener("click", ()=>{
        editDiv.style.display = "none";
    });

    const editProfitBtn = document.querySelector(".open-edit-profit");
    const closeProfitBtn = document.querySelector(".edit-profit-btn");
    const editProfitDiv = document.querySelector(".edit-profit");
    editProfitBtn.addEventListener("click", ()=>{
        editProfitDiv.style.display = "flex";
    });
    closeProfitBtn.addEventListener("click", ()=>{
        editProfitDiv.style.display = "none";
    });
</script>
<?php require_once("includes/components/footer.php") ?>
