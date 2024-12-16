<?php
session_start();
include "../include/config.php"
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
		
		<!--dashboard content css-->
		<!-- <link rel="stylesheet" href="../css/dashboard.css"> -->
<link rel="stylesheet" href="css/dashboard.css">
		<!-- FullCalendar CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-qWX4OROtBwV1F70YYV+SvWIytzDxWqGozDw3NT8ORzFEppJxA6fs9PBhXid5cwBh" crossorigin="anonymous">
<style>
    .doctor-dashboard{
        background-image:url("img/AppointBG.jpg");

    }
</style>
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
											<li class="active"><a href="dash.php">Home</a>
											</li>
											<li><a href="appointments.php">Appointments</a></li>
											<li><a href="history.php">History</a>
											</li>
											<li><a href="reports.php">Reports</a>
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
		 <div class="doctor-dashboard">
			<div class="container mt-4">
				<!-- Greeting Section -->
				<div class="greeting-section">
					<h2 class="greeting-text">Good Morning, <span class="doctor-name">Dr. <?php echo htmlspecialchars($_SESSION['Doctor_Name']); ?></span></h2>
				</div>
		
				<!-- Card View and Calendar -->
<div class="row mt-4">
    <!-- Card View -->
    <div class="col-lg-6">
        <div class="dashboard-card-group">
            <div class="dashboard-card">
                <h4>Total Patients</h4>
                <p class="card-data" id="total-patients">120</p>
                <p class="card-info">An increase of 10% compared to last month.</p>
            </div>
            <div class="dashboard-card">
                <h4>Patients This Month</h4>
                <p class="card-data" id="patients-this-month">25</p>
                <p class="card-info">Appointments are filling up fast!</p>
            </div>
        </div>
        <div class="additional-info mt-3">
            <h5>Quick Stats</h5>
            <ul>
                <li>Average Daily Patients: 8</li>
                <li>Critical Cases This Month: 3</li>
                <li>Most Booked Day: Tuesday</li>
            </ul>
        </div>
    </div>

    <!-- Calendar -->
    <div class="col-lg-6">
        <div class="dashboard-calendar">
            <h4>Upcoming Events & Appointments</h4>
            <div id="calendar"></div>
        </div>
    </div>
</div>	
<div class="custom-cards-container">
    <!-- Upcoming Patients Card -->
    <div class="custom-card custom-upcoming-patients-card">
        <h2 class="custom-card-title">Recent Patients</h2>
        <div class="custom-appointment-container">
            <?php
            // Query to fetch patients with 'True' status and 'Upcoming' appointments
			$doctor_id = $_SESSION['Doctor_ID'];

			// Query to fetch patients with 'True' status and 'Upcoming' appointments for the logged-in doctor
			$query = "SELECT * FROM appointments WHERE status='True' AND appoint='Upcoming' AND Doctor_ID='$doctor_id'";
			$result = $conn->query($query);
			
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					// Fetch patient details
					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
					$visit_type = $row['visit']; // Type of visit (e.g., follow-up, consultation)
					$selected_date = $row['selected_date'];
					$pain = $row['pain']; // Determines urgency level
					$phone_number = $row['phone_number']; // Patient phone number
			
					// Determine urgency class and title based on pain level
					$urgency_class = ($pain == 1) ? "custom-urgency-low" : "custom-urgency-high";
					$urgency_title = ($pain == 1) ? "Low Urgency" : "High Urgency";
					?>
					<div class="custom-appointment-row">
						<div class="custom-profile-info">
							<div class="custom-profile-photo">
								<img src="img/author2.jpg" alt="Profile Photo"> <!-- Replace with the patient's actual photo if available -->
							</div>
							<div class="custom-profile-name">
								<?php echo htmlspecialchars($first_name . ' ' . $last_name); ?><br>
								<span class="custom-visit-type"><?php echo htmlspecialchars($visit_type); ?></span>
							</div>
						</div>
						<div class="custom-time-slot">
							<?php echo htmlspecialchars($selected_date); ?>
						</div>
						<div class="custom-urgency">
							<span class="custom-urgency-circle <?php echo $urgency_class; ?>" 
								  title="<?php echo $urgency_title; ?>"></span>
						</div>
						<div class="custom-action-buttons">
							<button class="custom-call-btn">
								Call Patient: <?php echo htmlspecialchars($phone_number); ?>
							</button>
						</div>
					</div>
					<?php
				}
			} else {
				// No upcoming patients found
				echo '<div class="custom-no-patients">No upcoming patients.</div>';
			}
			
			// Close the database connection
			$conn->close();
			?>
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

		<script src="patientpopup.js"></script>
		<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-4U26oUQeuwzXpE/bNjszGG3lp17FQofTEbGDDGz9h1VqgWQflR8rEqiSUfO4W2ji" crossorigin="anonymous"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                { title: 'Checkup - John Doe', start: '2024-11-25' },
                { title: 'Consultation - Mike Ross', start: '2024-11-26' },
            ],
        });
        calendar.render();
    });
</script>

    </body>
</html>