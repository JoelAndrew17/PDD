<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../include/config.php"; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    // Check if file is uploaded
    if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $targetDir = "../homepage/uploads/";
        $fileName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Ensure the uploads directory exists
        if (!is_dir($targetDir)) {
            die("Uploads directory does not exist.");
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Update the database for file path and status
            $query = "
                UPDATE appointments 
                SET 
                    ehr_path = CASE 
                        WHEN ehr_path IS NULL OR ehr_path = '' THEN ? 
                        ELSE CONCAT(ehr_path, ',', ?) 
                    END, 
                    appoint = 'Completed' 
                WHERE ID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $fileName, $fileName, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "File uploaded, status updated to 'Completed', and record updated successfully.";
            } else {
                echo "Failed to update the database. Verify if the ID exists.";
            }
            $stmt->close();
        } else {
            die("File upload failed.");
        }
    } else {
        die("No file uploaded.");
    }
}
$conn->close();
?>
