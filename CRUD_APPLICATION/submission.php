<?php
header("Location: index.html");
exit;
?>

<?php

//Connection to MySQL
$servername = "localhost"; // changed from 127.0.0.1 to localhost
$username = "root";
$password = ""; // changed from "@Pudgeewarp02" to ""
$dbname = "phpdemo";

$conn = new mysqli($servername, $username, $password, $dbname);

//alternative
//$conn = new mysqli("127.0.0.1", "root", "@Pudgeewarp02", "phpdemo");

//Check Connection
if($conn->connect_error)
{
  die("Connection Failed: " . $conn->connect_error);
}

// Initialize message variable
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the submitted data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);

  // Execute the statement
  if ($stmt->execute()) {
    $message = "New record created successfully";
  } else {
    $message = "Error: " . $stmt->error;
  }

  // Close the statement
  $stmt->close();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submission</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('1.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: white;
    }
    .content {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 20px;
      border-radius: 10px;
      max-width: 800px;
      margin: 100px auto;
    }
  </style>
</head>
<body>
  <div class="content">
    <!-- Content can be added here if needed -->
  </div>
</body>
</html>