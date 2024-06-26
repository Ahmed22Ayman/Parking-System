<?php
include('header.php');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        <span>Dashboard</span>
                    </h1>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-n10">

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>All Parking Lot</p>
                            <p>
                                <?php

                                $countQuery = "SELECT count(id) FROM parking_lot WHERE status='Active'";
                                $stmt = $conn->prepare($countQuery);
                                $stmt->execute();
                                $rowCount = $stmt->fetch(PDO::FETCH_NUM);
                                echo reset($rowCount);
                                ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>Booked Space</p>
                            <p>
                                <?php

                                $countQuery = "SELECT count(id) FROM booking WHERE status='Active'";
                                $stmt = $conn->prepare($countQuery);
                                $stmt->execute();
                                $rowCount = $stmt->fetch(PDO::FETCH_NUM);
                                echo reset($rowCount);
                                ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>Available Space</p>
                            <p>
                                <?php

                                $countQuery = "SELECT count(id) FROM booking WHERE status='Inactive'";
                                $stmt = $conn->prepare($countQuery);
                                $stmt->execute();
                                $rowCount = $stmt->fetch(PDO::FETCH_NUM);
                                echo reset($rowCount);
                                ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>Total Users</p>
                            <p>
                                <?php

                                $countQuery = "SELECT count(id) FROM authentication";
                                $stmt = $conn->prepare($countQuery);
                                $stmt->execute();
                                $rowCount = $stmt->fetch(PDO::FETCH_NUM);
                                echo reset($rowCount);
                                ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <?php include('footer.php') ?>
</div>
</div>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>

</html>