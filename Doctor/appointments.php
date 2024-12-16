<?php
session_start();
// Ensure the Doctor_ID is set in the session
$doctor_id = isset($_SESSION['Doctor_ID']) ? $_SESSION['Doctor_ID'] : null;
if (!$doctor_id) {
    // Redirect or show an error if Doctor_ID is not available
    echo "Doctor not logged in.";
    exit();
}
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
        <!-- FullCalendar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <link rel="stylesheet" href="appointment.css">

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
											<li class="active"><a href="#">Appointments</a></li>
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
         <div class="BGwrapper">

             <!-- Appointment Table -->
             <div class="appointment-table">
            <h2>Appointment Requests</h2>
            <hr>
            <div class="appointment-container">  
                <?php
                // Modify query to select records where status='False', appoint='Hold' and Doctor_ID matches session Doctor_ID
                $query2 = "SELECT * FROM appointments WHERE status='False' AND appoint='Hold' AND Doctor_ID='$doctor_id'";
                $result2 = $conn->query($query2);

                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        $id = $row['ID'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $selected_date = $row['selected_date'];
                        $pain = $row['pain'];

                        echo '
                        <div class="appointment-row" data-patient="'.$first_name.' '.$last_name.'" data-visit="Monthly Visit" data-time="'.$selected_date.'" data-urgency="Medium Urgency">
                            <div class="profile-info">
                                <div class="profile-photo">
                                    <img src="img/author1.jpg" alt="Profile Photo">
                                </div>
                                <div class="profile-name">
                                    '.$first_name.' '.$last_name.'<br>
                                    <span class="visit-type">Monthly Visit</span>
                                </div>
                            </div>
                            <div class="time-slot">'.$selected_date.'</div>
                ';

                        // Show urgency based on pain level
                        if ($pain == '1') {
                            echo '<div class="urgency">
                                    <span class="urgency-circle urgency-low" title="Low Urgency"></span>
                                </div>';
                        } else {
                            echo '<div class="urgency">
                                    <span class="urgency-circle urgency-medium" title="Medium Urgency"></span>
                                </div>';
                        }

                        echo '
                            <div class="action-buttons">
                                <a href="approve.php?id='.$id.'"><button class="approve-btn">Approve</button></a>
                                <a href="deny.php?id='.$id.'"><button class="deny-btn">Deny</button></a>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<tr><td colspan="4">No data in the table.</td></tr>';
                }

                $conn->close();
                ?>
            </div>
        </div>

                <!-- Upcoming Patients and Consultation Details (Side by Side) -->
<div class="cards-container">
    <!-- Upcoming Patients Card -->
    <div class="card upcoming-patients-card">
        <h2>Upcoming Patients</h2>
        <div class="appointment-container">
            <?php
            include "../include/config.php";

            // Assuming Doctor_ID is stored in session
            $doctor_id = $_SESSION['Doctor_ID']; // Retrieve logged-in doctor's ID

            // Modify query to filter by Doctor_ID
            $query = "SELECT * FROM appointments WHERE status='True' AND appoint='Upcoming' AND doctor_id='$doctor_id'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $visit_type = $row['visit']; // Assuming 'visit_type' column exists in your DB
                    $selected_date = $row['selected_date'];
                    $pain = $row['pain']; // Determines urgency level
                    $filename = $row['ehr_path'];

                    // Determine urgency class and title based on pain level
                    if ($pain == 1) {
                        $urgency_class = "urgency-low";
                        $urgency_title = "Low Urgency";
                    } else {
                        $urgency_class = "urgency-high";
                        $urgency_title = "High Urgency";
                    }
            ?>
                    <div class="appointment-row ai-analysis" 
                        data-docname="<?php echo htmlspecialchars($filename, ENT_QUOTES, 'UTF-8'); ?>" 
                        data-pain="<?php echo htmlspecialchars($pain, ENT_QUOTES, 'UTF-8'); ?>" 
                        data-issue="<?php echo htmlspecialchars($row['Issue'], ENT_QUOTES, 'UTF-8'); ?>" 
                        data-id="<?php echo htmlspecialchars($row['ID'], ENT_QUOTES, 'UTF-8'); ?>" 
                        data-patient="<?php echo htmlspecialchars($first_name . ' ' . $last_name, ENT_QUOTES, 'UTF-8'); ?>" 
                        data-visit="<?php echo htmlspecialchars($visit_type, ENT_QUOTES, 'UTF-8'); ?>" 
                        data-time="<?php echo htmlspecialchars($selected_date, ENT_QUOTES, 'UTF-8'); ?>" 
                        data-urgency="<?php echo htmlspecialchars($urgency_title, ENT_QUOTES, 'UTF-8'); ?>">

                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="img/author2.jpg" alt="Profile Photo"> <!-- Replace with actual photo if available -->
                            </div>
                            <div class="profile-name">
                                <?php echo $first_name . ' ' . $last_name; ?><br>
                                <span class="visit-type"><?php echo $visit_type; ?></span>
                            </div>
                        </div>
                        <div class="time-slot"><?php echo $selected_date; ?></div>
                        <div class="urgency">
                            <span class="urgency-circle <?php echo $urgency_class; ?>" title="<?php echo $urgency_title; ?>"></span>
                        </div>
                        <div class="action-buttons">
                            <button class="message-btn">Message Patient</button>
                            <a href="AddRecords.php?id=<?php echo $row['ID']; ?>">
                                <button class="call-btn">Complete Consultation</button>
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div>No upcoming patients.</div>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <div class="card consultation-card">
        <h2>Consultation Details</h2>
        <!-- Unique Loading Animation -->
        <div id="consultation-loading" style="display:none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Consultation Details -->
        <div id="consultation-details" class="consultation-details"></div>
    </div>                
</div>
        <script>
$(document).ready(function () {
    $(".ai-analysis").on("click", function (event) {
        if ($(event.target).hasClass("call-btn")) {
            return;
        }

        event.preventDefault();

        // Show unique loading animation
        $("#consultation-loading").show();

        const docname = $(this).data("docname") || "";
        const pain = $(this).data("pain") || "";
        const issue = $(this).data("issue") || "";
        const id = $(this).data("id") || "";

        const formData = {
            docname: docname,
            pain: pain,
            issue: issue,
            id: id
        };

        $.ajax({
            url: "../testing/send_to_python.php",
            method: "GET",
            data: formData,
            dataType: "json",
            success: function (response) {
                $("#consultation-details").html(`
                    <p><strong>Condition:</strong> ${response.condition}</p>
                    <p><strong>Reason:</strong> ${response.reason}</p>
                    <p><strong>Analysis:</strong> ${response.analysis}</p>
                `);
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
            },
            complete: function () {
                // Hide the unique loading animation
                $("#consultation-loading").hide();
            }
        });
    });
});

        </script>

        
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
    </body>
</html>