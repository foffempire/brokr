<?php require_once("includes/init.php") ?>
<?php define("TITLE", "Dashboard"); ?>
<?php require_once("includes/components/header.php") ?>
<?php
    if(!logged_in()){
        Helper::redirect("login");
    }

    $stmt = $kon->prepare("SELECT * FROM kyc ORDER BY id DESC");
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
            <h6>KYC</h6>
            <div class="text-center py-4">
            </div>
            <div class="table-responsive font-12">
                <table class="table table-striped table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User email</th>
                            <th scope="col">Names</th>
                            <th scope="col">Type</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $key) { ?>
                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $key['email'] ?></td>
                                <td><?= $key['fullnames'] ?></td>
                                <td><?= $key['verify_type'] ?></td>
                                <td>
                                    <img src="../images/kyc/<?= $key['image'] ?>" alt="" width='50'>                                    
                                </td>
                                <td><?= $key['status'] ?></td>
                                <td>
                                <?php if($key['status']=='Under review'){ ?>
                                    <a href='process?confirmKYC=<?= $key['id'] ?>' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-success'>Approve </button></a>

                                    <a href='process?rejectKYC=<?= $key['id'] ?>' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>Reject </button></a>
                                <?php }else{ ?>
                                    <a href='process?unConfirmKYC=<?= $key['id'] ?>' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-warning'>Reset </button></a>
                                <?php }?>
                                </td>
                                <td>
                                <?php if($key['status']=='Under review'){ ?>
                                    <a href='process?deleteKYC=<?= $key['id'] ?>' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>
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
                    <p>Approve (green): Change the status of the deposit to 'Approved'. </p>
                    <p>Reject (blue): Change the status of the deposit to 'Rejected'. </p>
                    <p>Reset (yellow): Change the status of the KYC to 'Under review'.</p>
                    <p>Delete (red): Delete the KYC</p>
                    </i>
                </small>
            </div>

        </div>
    </div>
</div>
    <!-- main content end -->

    

<?php require_once("includes/components/footer.php") ?>
