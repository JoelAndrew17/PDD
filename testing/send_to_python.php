<?php
header('Content-Type: application/json');

// Collect POST data from the AJAX request
$id = $_GET['id'];
$docname = $_GET['docname'];
$pain = $_GET['pain'];
$issue = $_GET['issue'];



$data = [
    "id" => $id,
    "doc_file" => $docname,
    "pain" => $pain,
    "issue" => $issue
];

$jsonData = json_encode($data);

// Set up the cURL request to the Python server
$url = 'http://localhost:8000'; // Python server URL
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);

// Execute the request and capture the response
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(["error" => "Failed to connect to the Python server."]);
} else {
    // Decode the response from Python
    $responseData = json_decode($response, true);

    // Return the response to the frontend
    echo json_encode($responseData);
}
?>
