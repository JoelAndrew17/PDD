<?php
include "../include/config.php"; // Database connection

// Get the appointment ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if a file is uploaded
        if (isset($_FILES['ehr_file']) && $_FILES['ehr_file']['error'] === UPLOAD_ERR_OK) {
            // Get the file details
            $fileTmpPath = $_FILES['ehr_file']['tmp_name'];
            $fileName = $_FILES['ehr_file']['name'];
            $uploadDir = '../uploads/'; // Directory for uploaded files
            $destPath = $uploadDir . $fileName;

            // Move the file to the upload directory
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update the database
                $query = "UPDATE appointments SET appoint='Completed', ehr_path='$destPath' WHERE ID='$id'";
                if ($conn->query($query) === TRUE) {
                    echo "<script type='text/javascript'>alert('Appointment marked as Completed. File uploaded successfully.');window.location.href='appointments.php';</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "No file uploaded or there was an error during upload.";
        }
    }
} else {
    echo "No appointment ID provided.";
}

$conn->close();
?>
