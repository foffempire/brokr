<?php
require_once "includes/init.php";
define("PAGE","support");

if(!logged_in()){
    Helper::redirect("../login");
}

$qr = $kon->prepare("SELECT * FROM support WHERE email = :em ORDER BY id DESC");
$qr->bindParam("em", $email);
$qr->execute();
$rows=$qr->fetchAll(PDO::FETCH_ASSOC);
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
                                    <h3 class="title">Support Tickets</h3>
                                    <div class="card-header-links">
                                    <a href="./support-ticket-new" class="card-header-link"
                                        >Create Ticket</a
                                    >
                                    </div>
                                </div>
                                <div class="site-card-body">
                    <div class="site-datatable">
                        <div class="row table-responsive">
                            <div class="col-xl-12">
                                <table id="dataTable" class="display data-table">
                                    <thead>
                                    <tr>
                                        <th>Ticked ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $row) { ?>
                                            <tr>
                                                <td><?= $row['ticketid'] ?></td>
                                                <td><?= $row['title'] ?></td>
                                                <td>
                                                    <?= strlen($row['description'])> 20 ? substr($row['description'],0,20).'...' : $row['description']; ?>
                                                </td>
                                                <td><?= $row['date_added'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
