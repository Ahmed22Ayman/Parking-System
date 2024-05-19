<?php
include('header.php');

?>


<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                        <span>Parking Slots</span>
                    </h1>
                </div>
            </div>
        </div>

        <!--Your Booking Form-->
        <div class="container-fluid mt-n10">
            <div class="card mb-4">
                <div class="card-header">Your Bookings</div>
                <div class="card-body">

                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Index Number </th>
                                    <th>Car Number </th>
                                    <th>Parking Name </th>
                                    <th>Contact</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Release Space</th>
                                </tr>
                            </thead>
                            <tbody>