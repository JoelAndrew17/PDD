<?php
session_start();
$Username = $_POST['Username'];
$pass = $_POST['pass'];

if (!empty($Username) || !empty($pass)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "medical";
    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    } else {
        // Check in 'register' table
        $SELECT_PATIENT = "SELECT * FROM register WHERE Username = '$Username' AND pass = '$pass'";
        $patientQuery = $conn->query($SELECT_PATIENT);
        
        if ($patientQuery->num_rows == 1) {
            $userinfo = $patientQuery->fetch_assoc();
            $_SESSION['ID'] = $userinfo['ID'];
            header("Location: homepage/index.html");
            exit();
        }

        // Check in 'doctor_details' table
        $SELECT_DOCTOR = "SELECT * FROM doctor_details WHERE Doctor_Name = '$Username' AND Doctor_password = '$pass'";
        $doctorQuery = $conn->query($SELECT_DOCTOR);

        if ($doctorQuery->num_rows == 1) {
            $doctorInfo = $doctorQuery->fetch_assoc();
            $_SESSION['Doctor_ID'] = $doctorInfo['Doctor_ID'];
            $_SESSION['Doctor_Name'] = $doctorInfo['Doctor_Name']; // Store the doctor's name
            header("Location: Doctor/dash.php");
            exit();
        }

        // If no match in either table
        echo "<script>
                alert('Incorrect username or password.');
                window.location.href = 'login.html';
              </script>";
    }
} else {
    echo "All fields are required.";
    die();
}
?>
