<?php


    // Collect data from the form
    $firstName = $_POST['PatientFirstName'];
    $lastName = $_POST['PatientSecondName'];
    $email = $_POST['PatientEmail'];
    $phoneNumber = $_POST['PatientNumber'];
    $dob = $_POST['PDOB'];
    $gender = $_POST['gender'];
    $visit = $_POST['visit'];
    $pain = $_POST['pain'];
    $Issue = $_POST['Issue'];
    $selectedDate = $_POST['SelectedDate'];
    $Doctor_ID = $_POST['Doctor_ID'];

   

    // Handle file upload for EHR (Electronic Health Record)
    if (isset($_FILES['EHR']) && $_FILES['EHR']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["EHR"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow only specific file formats
        $allowedTypes = ['pdf', 'docx', 'jpg', 'png'];
        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($_FILES["EHR"]["tmp_name"], $targetFilePath)) {
                $fileUploaded = true;
            } else {
                $fileUploaded = false;
                $errorMsg = "File upload failed. Please try again.";
            }
        } else {
            $fileUploaded = false;
            $errorMsg = "Only PDF, DOCX, JPG, and PNG files are allowed.";
        }
    } else {
        $fileUploaded = false;
    }

    // Connect to the database (replace with your database details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medical";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, email, phone_number, dob, gender, visit, pain, Issue, selected_date, ehr_path, Doctor_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $ehrPath = $fileUploaded ? $targetFilePath : NULL;
    $stmt->bind_param("sssssssssssi", $firstName, $lastName, $email, $phoneNumber, $dob, $gender, $visit, $pain, $Issue, $selectedDate, $ehrPath, $Doctor_ID);

    if ($stmt->execute()) {
        header("Location: index.html"); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>
