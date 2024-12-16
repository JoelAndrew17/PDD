<?php
include "../include/config.php";

$id = $_GET['id'];
    
$sql = "UPDATE appointments SET appoint='Upcoming',status='True' WHERE ID ='$id'";

if ($conn->query($sql) === TRUE) {

    echo "<script type='text/javascript'>alert('Appointment Successfully');window.location.href='appointments.php';</script>";
 
    }else {
        echo 'Error updating user details: ' . $conn->error;
    }


$conn->close();
?>