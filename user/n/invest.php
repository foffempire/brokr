<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Dashboard"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }

    $t = new Transactions($kon);
?>
<style>
    button{
        font-size:12px !important;
    }
</style>
<!-- main content start -->
<div class="main-content">
    <div class="main-content-wrapper">
        <div class="container">
            <h6>Investments</h6>
            <div class="text-center py-4">
                <small>
                    <a href="?query=pending" class="text-primary">Pending</a>
                    <span class="px-3">|</span>
                    <a href="?query=running" class="text-warning">Running</a>
                    <span class="px-3">|</span>
                    <a href="?query=completed" class="text-success">Completed</a>
                    <span class="px-3">|</span>
                    <a href="invest" class="text-dark">All</a>
                </small>
            </div>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Package</th>
                            <th scope="col">Gateway</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Added</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        if(isset($_GET['query'])){
                            $t->queriedInvestments($_GET['query']);
                        }else{
                            $t->investments();                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <small>
                    <i>
                    <p>NOTE:</p>
                    <p>Completed(Green): Change the status of the investment to 'completed'. You should top up the user main balance when completed</p>
                    <p>Running(yellow): Change the status of the investment to 'running'.</p>
                    <p>Pending(blue): Change the status of the investment to 'pending'. This means the user's deposit is not yet confirm</p>
                    <p>Delete(red): Delete pending investments</p>
                    </i>
                </small>
            </div>
        </div>
    </div>
</div>
    <!-- main content end -->

    

<?php require_once("includes/components/footer.php") ?>
