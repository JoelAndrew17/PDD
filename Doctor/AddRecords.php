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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<link rel="stylesheet" href="AddRecords.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  
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
									<a href="Book-Appointment.html" class="btn">Dr Placeholder</a>
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
        <div class="BGwrapper" style="
        background-image: url('img/AppointBG.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat;
        height: 1500px;">
		<?php
		if (isset($_GET['id'])) {
			$record_id = $_GET['id'];

			// Use $record_id to fetch or update the record in the database
			echo "Record ID: " . $record_id;
		} else {
			echo "No ID provided.";
		}
		?>

<div class="report-editor">
    <div class="report-controls">
        <h1>Edit Medical Report</h1>
        <button class="upload-btn" id="uploadReportBtn">Upload</button> <!-- Upload button -->
        <a href="appointments.php"><button class="upload-btn" type="button">Back</button></a>
        <select class="mudiyela" id="formatSelect">
            <option value="pdf">PDF</option>
            <option value="doc">DOC</option>
        </select>
        <button class="download-btn" onclick="downloadReport()">Download</button>
    </div>
</div>

    <div class="report-container">
      <section class="report-section" id="patient-details" contenteditable="true">
        <h2>Patient Details</h2>
        <p><strong>Name:</strong> Enter patient name</p>
        <p><strong>Age:</strong> Enter patient age</p>
        <p><strong>Gender:</strong> Enter gender</p>
      </section>

      <section class="report-section" id="chief-complaint" contenteditable="true">
        <h2>Chief Complaint</h2>
        <p>Describe the primary issue...</p>
      </section>

      <section class="report-section" id="present-illness" contenteditable="true">
        <h2>History of Present Illness</h2>
        <p><strong>Onset:</strong> </p>
        <p><strong>Frequency:</strong> </p>
        <p><strong>Trigger:</strong> </p>
        <p><strong>Symptoms:</strong> </p>
      </section>

      <section class="report-section" id="medical-history" contenteditable="true">
        <h2>Medical History</h2>
        <p><strong>Past Conditions:</strong> </p>
        <p><strong>Medications:</strong> </p>
        <p><strong>Family History:</strong> </p>
      </section>

      <section class="report-section" id="lifestyle-history" contenteditable="true">
        <h2>Lifestyle and Occupational History</h2>
        <p>Enter relevant details...</p>
      </section>

      <section class="report-section" id="examination-findings" contenteditable="true">
        <h2>Examination Findings</h2>
        <p>Enter observations...</p>
      </section>

      <section class="report-section" id="assessment" contenteditable="true">
        <h2>Assessment</h2>
        <p>Provide assessment details...</p>
      </section>

      <section class="report-section" id="plans" contenteditable="true">
        <h2>Plans and Recommendations</h2>
        <p>Enter recommendations...</p>
      </section>

      <section class="report-section" id="doctor-notes" contenteditable="true">
        <h2>Doctor Notes</h2>
        <p>Enter notes here...</p>
      </section>

      <section class="report-section" id="doctor-signoff" contenteditable="true">
        <h2>Doctor Sign-Off</h2>
        <p><strong>Signature:</strong> </p>
        <p><strong>Date:</strong> </p>
      </section>
    </div>
  </div>
        </div>
<!-- Modal for Upload -->
<div class="modal" id="uploadReportModal" tabindex="-1" role="dialog" aria-labelledby="uploadReportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadReportModalLabel">Upload Medical Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadReportForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="uploadReportId"> <!-- Hidden input to store the patient ID -->
                    <div class="form-group">
                        <label for="file">Select File</label>
						<input type="hidden" name="id" value="<?php echo $record_id; ?>">
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Uploads</button>
                </form>
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
		<script>
		function downloadReport() {
			const reportElement = document.querySelector(".report-container"); // Select the report container

			const { jsPDF } = window.jspdf;
			const pdf = new jsPDF("p", "mm", "a4");

			// Adjust scaling and fit content properly on A4
			pdf.html(reportElement, {
				callback: function (doc) {
					doc.save("Medical_Report.pdf"); // Save the PDF file
				},
				x: 10, // Left margin
				y: 10, // Top margin
				width: 190, // Adjust content width to fit A4 page (210mm - 20mm margins)
				windowWidth: reportElement.scrollWidth * 1.5, // Scale the content to make it larger
			});
		}
		$(document).ready(function () {
    // Handle the Upload button click to show the modal
    $('#uploadReportBtn').on('click', function () {
        var id = $(this).data('id'); // Retrieve the patient ID (if applicable)
        $('#uploadReportId').val(id); // Set the patient ID in the hidden input field
        $('#uploadReportModal').modal('show'); // Show the modal
    });

    // Handle the file upload form submission
    $('#uploadReportForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this); // Collect the form data including the file

        $.ajax({
            url: 'upload_file.php', // The backend script to handle the file upload
            method: 'POST',
            data: formData, // Send the form data
            contentType: false, // Do not set content type because it's multipart
            processData: false, // Do not process the data, let the browser handle it
            success: function (response) {
                alert(response); // Display success/failure response from the server
                $('#uploadReportModal').modal('hide'); // Close the modal on success
            },
            error: function () {
                alert('Failed to upload report.');
            }
        });
    });
});

		</script>	
    </body>
</html>