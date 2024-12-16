<?php
session_start();
include "../include/config.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
        <title>WellConnect</title>
		
		<!-- Favicon -->
        <link rel="icon" href="img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <!-- FullCalendar CSS -->
    </head>
    <body>
	
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
		<!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							<ul class="top-link">
								<li><a href="about.html">About</a></li>
								<li><a href="faq.html">FAQ</a></li>
							</ul>
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+99 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:Mudiyela@gmail.com">Mudiyela@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Topbar -->
			<!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="dash.php"><img src="img/logo.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
											<li><a href="dash.php">Home</a>
											</li>
											<li><a href="appointments.php">Appointments</a></li>
											<li><a href="history.php">History</a>
											</li>
											<li class="active"><a href="#">Reports</a>
											</li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								<div class="get-quote">
								<?php
									if (isset($_SESSION['Doctor_Name'])) {
										echo '<a href="#" class="btn">Dr ' . htmlspecialchars($_SESSION['Doctor_Name']) . '</a>';
									} else {
										echo '<a href="login.html" class="btn">Login</a>';
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		<hr>
<!-- Header -->
<?php

// Fetch patient records from the database
$doctor_id = $_SESSION['Doctor_ID']; // Retrieve logged-in doctor's ID

// Fetch patient records from the database for the specific doctor
$query = "SELECT * FROM appointments WHERE status='True' AND doctor_id='$doctor_id'";
$result = $conn->query($query);
?>

<header class="header">
    <div class="container">
        <h2>Patient Records</h2>
    </div>
</header>

<!-- Table of Patient Records -->
<div class="container mt-4">
    <table class="table table-bordered patient-records-table">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Visit Type</th>
                <th>Appointment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['ID'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $visit_type = $row['visit']; // Assuming 'visit' is a column
                    $selected_date = $row['selected_date'];
                    
                    echo '
                    <tr>
                        <td>' . $first_name . ' ' . $last_name . '</td>
                        <td>' . $visit_type . '</td>
                        <td>' . $selected_date . '</td>
                        <td>
                            <button class="btn btn-info patient-view-files-btn" data-id="' . $row['ID'] . '">View Files</button>
                        </td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="4">No patient records found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal to Show Files (hidden by default) -->
<div class="modal" id="patientFilesModal" tabindex="-1" role="dialog" aria-labelledby="patientFilesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientFilesModalLabel">Patient Files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Patient files will be displayed here -->
                <div id="patient-file-list">
                    <!-- Files will dynamically load here based on the selected patient -->
                </div>
            </div>
        </div>
    </div>
</div>


		<!-- jquery Min JS -->
        <script src="js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="js/easing.js"></script>
		<!-- Color JS -->
		<script src="js/colors.js"></script>
		<!-- Popper JS -->
		<script src="js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="js/main.js"></script>

<!-- View reports JS -->
<script>
    $(document).ready(function () {
    $('.patient-view-files-btn').on('click', function () {
        var id = $(this).data('id'); // Retrieve the ID from the button's data-id attribute

        if (!id) {
            alert('Error: Invalid ID'); // Debugging: Ensure ID is present
            return;
        }

        // AJAX request to fetch files
        $.ajax({
            url: 'fetch_files.php',
            method: 'POST',
            data: { id: id },
            success: function (response) {
                // Populate the modal with the fetched files
                $('#patient-file-list').html(response);
                // Show the modal
                $('#patientFilesModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch patient records.');
            }
        });
    });
});

</script>
    </body>
</html>