<?php
// Update these with your actual DB details
$host = "localhost";
$username = "your_mysql_username";
$password = "your_mysql_password";
$dbname = "your_database_name";

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed.";
    exit();
}

// Get the response from POST
$response = $_POST['response'] ?? null;

if ($response === "Yes" || $response === "No") {
    $stmt = $conn->prepare("INSERT INTO responses (response) VALUES (?)");
    $stmt->bind_param("s", $response);
    $stmt->execute();
    $stmt->close();
    echo "Recorded";
} else {
    http_response_code(400);
    echo "Invalid response";
}

$conn->close();
?>
