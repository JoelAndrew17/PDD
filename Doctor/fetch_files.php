<?php
include "../include/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;

    if (!$id) {
        die('Invalid ID.'); // Ensure ID is received
    }

    // Query to fetch the `ehr_path` for the specific record
    $query = "SELECT ehr_path FROM appointments WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ehr_path = $row['ehr_path'];

        if (!empty($ehr_path)) {
            // Base path to where files are located
            $basePath = '/med/login/homepage/';
            $defaultPath = 'uploads/';

            $files = explode(',', $ehr_path);
            echo '<ul>';
            foreach ($files as $file) {
                $file = trim($file); // Remove any extra spaces

                // Add default path if no directory is present
                if (strpos($file, '/') === false) {
                    $file = $defaultPath . $file;
                }

                // Construct the correct file path
                $filePath = $basePath . htmlspecialchars($file);
                echo '<li><a href="' . $filePath . '" target="_blank">' . htmlspecialchars(basename($file)) . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<div>No EHR files available for this patient.</div>';
        }
    } else {
        echo '<div>Patient records not found.</div>';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid Request.';
}
?>
