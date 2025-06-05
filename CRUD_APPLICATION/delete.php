<?php
// Connection to MySQL
$servername = "localhost"; // Use localhost for socket connection
$username = "root";
$password = ""; // Leave empty for XAMPP default
$dbname = "phpdemo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
  die('<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Delete Contact - Genesis_Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body { min-height: 100vh; background: #18122B; color: #fff; }
      .alert { margin-top: 3rem; }
    </style>
  </head>
  <body>
    <div class=\"container\"><div class=\"alert alert-danger\">Connection Failed: ' . $conn->connect_error . '</div></div>
  </body>
  </html>');
}

// Check if ID is set and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Delete Contact - Genesis_Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body { min-height: 100vh; background: #18122B; color: #fff; }
      .alert { margin-top: 3rem; }
    </style>
  </head>
  <body>
    <div class="container"><div class="alert alert-danger">No ID provided.</div></div>
  </body>
  </html>';
} else {
  $idvar = (int)$_GET['id'];

  // Perform delete query
  $sql = "DELETE FROM contacts WHERE id = $idvar";
  $conn->query($sql);

  // Close connection and redirect
  $conn->close();

  header("Location: view.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Delete Contact - Genesis_Coding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      background: url('1.png') center center / cover no-repeat fixed #18122B;
      font-family: "Montserrat", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
    }
    .alert { margin-top: 3rem; }
    /* ...reuse card/footer styles from index.html... */
    @media (max-width: 576px) {
      .alert { font-size: 0.95rem; }
    }
  </style>
</head>
<body>
  <!-- ...existing body content... -->
  <footer class="footer mt-5 border-0" style="background:rgba(30,34,43,0.95); box-shadow:0 -2px 16px 0 rgba(0,0,0,0.12);">
    <div class="container text-center py-3">
      <span class="fw-semibold text-info">&copy; 2025 Gen.Tech_Coding</span>
      <span class="mx-2 text-secondary">|</span>
      <span class="text-light">At your service. Be blessed!</span>
    </div>
  </footer>
</body>
</html>