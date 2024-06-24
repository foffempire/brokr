<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Dashboard"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }


    $t = new Transactions($kon);
?>

<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">
        <div class="container">
            <h6>Withdrawals</h6>
            <div class="text-center py-4">
                <small>
                    <a href="?query=pending" class="text-Warning">Pending</a>
                    <span class="px-3">|</span>
                    <a href="?query=completed" class="text-success">Completed</a>
                    <span class="px-3">|</span>
                    <a href="withdraw" class="text-dark">All</a>
                </small>
            </div>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Address</th>
                            <th scope="col">Amount</th>
                            <th scope="col">status</th>
                            <th scope="col">Date Added</th>
                            <th scope="col" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($_GET['query'])){
                            $t->queriedWithdrawals($_GET['query']);
                        }else{
                            $t->withdrawals();                            
                        }
                        ?>                         
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- main content end -->

    

<?php require_once("includes/components/footer.php") ?>
