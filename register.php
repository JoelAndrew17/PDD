<?php

$Username = $_POST['Username'];
$EUmail = $_POST['EUmail'];
$pass = $_POST['pass'];

if (!empty($Username) && !empty($EUmail) && !empty($pass)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "medical";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT EUmail FROM register WHERE EUmail = ? LIMIT 1";
        $INSERT = "INSERT INTO register (Username, EUmail, pass) VALUES (?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $EUmail);
        $stmt->execute();
        $stmt->bind_result($EUmail);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // Check if email is already registered
        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $Username, $EUmail, $pass);
            $stmt->execute();
            
            // Display success message and redirect
            echo "<script>
                    alert('Registration successful! Redirecting to login page...');
                    window.location.href = 'login.html'; // Change to the actual path of your login page
                  </script>";
        } else {
            echo "<script> 
                    alert('Someone already registered using this email.');
                    window.location.href = 'register.html';
                    </script>";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
