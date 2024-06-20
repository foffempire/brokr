    <?php include('includes/components/header.php') ?>

    <!--Side Nav-->
    <?php include('includes/components/sidebar.php') ?>
    <!--/Side Nav-->

    <div class="page-container">
        <div class="main-content">
            <div class="section-gap">
                <div class="container-fluid">
                                            
                        <div class="row">
        <div class="col">
            <div class="alert site-alert alert-dismissible fade show" role="alert">
                <div class="content">
                    <div class="icon"><i class="anticon anticon-warning"></i></div>
                                            You need to submit your
                        <strong>KYC and Other Documents</strong> before proceed to the system.
                                    </div>
                                    <div class="action">
                        <a href="./kyc" class="site-btn-sm grad-btn"><i
                                class="anticon anticon-info-circle"></i>Submit Now</a>
                        <a href="" class="site-btn-sm red-btn ms-2" type="button" data-bs-dismiss="alert"
                           aria-label="Close"><i class="anticon anticon-close"></i>Later</a>
                    </div>
                            </div>
        </div>
    </div>
                                        <!--Page Content-->
                        <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">All Deposit Log</h3>
                </div>
                <div class="site-card-body">
                    <div class="site-datatable">
                        <div class="row table-responsive">
                            <div class="col-xl-12">
                                <table id="dataTable" class="display data-table">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Transactions ID</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Status</th>
                                        <th>Method</th>
                                    </tr>
                                    </thead>
                                    <tbody>

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