<?php
include "../include/config.php"; // Include your DB connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to update the appoint column to 'Deny'
    $query = "UPDATE appointments SET appoint='Deny' WHERE ID=?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect back to the appointments page after updating
            header("Location: appointments.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

$conn->close();
?>
