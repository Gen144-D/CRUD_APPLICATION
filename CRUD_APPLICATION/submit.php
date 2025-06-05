<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdemo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die('<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Submit Contact - Genesis_Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        background: url("1.png") center center / cover no-repeat fixed #18122B;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        flex-direction: column;
      }
      .alert { margin-top: 3rem; }
    </style>
  </head>
  <body>
    <div class="container"><div class="alert alert-danger">Connection Failed: ' . $conn->connect_error . '</div></div>
    <footer class="footer mt-5 border-0" style="background:rgba(30,34,43,0.95); box-shadow:0 -2px 16px 0 rgba(0,0,0,0.12);">
      <div class="container text-center py-3">
        <span class="fw-semibold text-info">&copy; 2025 Gen.Tech_Coding</span>
        <span class="mx-2 text-secondary">|</span>
        <span class="text-light">At your service. Be blessed!</span>
      </div>
    </footer>
  </body>
  </html>');
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $subject && $message) {
  $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  header("Location: view.php");
  exit;
} else {
  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Submit Contact - Genesis_Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
        background: url("1.png") center center / cover no-repeat fixed #18122B;
        font-family: "Montserrat", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        flex-direction: column;
      }
      .alert { margin-top: 3rem; }
      @media (max-width: 576px) {
        .alert { font-size: 0.95rem; }
      }
    </style>
  </head>
  <body>
    <div class="container"><div class="alert alert-danger">All fields are required.</div></div>
    <footer class="footer mt-5 border-0" style="background:rgba(30,34,43,0.95); box-shadow:0 -2px 16px 0 rgba(0,0,0,0.12);">
      <div class="container text-center py-3">
        <span class="fw-semibold text-info">&copy; 2025 Gen.Tech_Coding</span>
        <span class="mx-2 text-secondary">|</span>
        <span class="text-light">At your service. Be blessed!</span>
      </div>
    </footer>
  </body>
  </html>';
}
?>