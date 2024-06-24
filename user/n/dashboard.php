<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Dashboard"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }


    $user = new Users($kon);
?>

<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">
        <div class="container">
            <h6>All Users</h6>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Names</th>
                            <th scope="col">Email</th>
                            <th scope="col">Location</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $user->allUsers() ?>                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- main content end -->

    

<?php require_once("includes/components/footer.php") ?>
