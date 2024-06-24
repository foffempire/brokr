<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Dashboard"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }

    $stmt = $kon->prepare("SELECT * FROM deposit ORDER BY id DESC");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $n=1;
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
            <h6>Deposit</h6>
            <div class="text-center py-4">
            </div>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User email</th>
                            <th scope="col">Gateway</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Added</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $key) { ?>
                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $key['email'] ?></td>
                                <td><?= $key['gateway'] ?></td>
                                <td><?= $key['amount'] ?></td>
                                <td>
                                    <img src="../images/deposit/<?= $key['image'] ?>" alt="" width='50'>                                    
                                </td>
                                <td><?= $key['status'] ?></td>
                                <td><?= $key['datetime'] ?></td>
                                <td>
                                <?php if($key['status']=='pending'){ ?>
                                    <a href='process?confirmDeposit=<?= $key['id'] ?>' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>mark as completed </button></a>
                                <?php }else{ ?>
                                    <a href='process?unConfirmDeposit=<?= $key['id'] ?>' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-warning'>mark as pending </button></a>
                                <?php }?>
                                </td>
                                <td>
                                <?php if($key['status']=='pending'){ ?>
                                    <a href='process?deleteDeposit=<?= $key['id'] ?>' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>
                                <?php }?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <small>
                    <i>
                    <p>NOTE:</p>
                    <p>Completed (blue): Change the status of the deposit to 'completed'. You should top up the user main balance when completed</p>
                    <p>Pending (yellow): Change the status of the deposit to 'pending'.</p>
                    <p>Delete (red): Delete the deposit</p>
                    </i>
                </small>
            </div>

        </div>
    </div>
</div>
    <!-- main content end -->

    

<?php require_once("includes/components/footer.php") ?>
