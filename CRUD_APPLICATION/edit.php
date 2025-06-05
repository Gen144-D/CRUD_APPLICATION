<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdemo";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die('<div class="alert alert-danger">Connection Failed: ' . $conn->connect_error . '</div>');
}

$id = $_GET['id'] ?? '';
if (!$id) {
  die('<div class="alert alert-danger">No ID provided.</div>');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $subject = $_POST['subject'] ?? '';
  $message = $_POST['message'] ?? '';
  if ($name && $email && $subject && $message) {
    $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, subject=?, message=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $subject, $message, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: view.php");
    exit;
  } else {
    $error = "All fields are required.";
  }
}

$result = $conn->query("SELECT * FROM contacts WHERE id=" . intval($id));
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Contact - Genesis_Coding</title>
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
    .card {
      border-radius: 0.75rem;
      box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 0.15);
      position: relative;
      z-index: 1;
    }
    .footer {
      background-color: #343a40;
      color: #adb5bd;
      padding: 1rem 0;
      margin-top: auto;
      text-align: center;
      font-size: 0.9rem;
    }
    .btn-primary {
      background-color: #0056b3;
      border-color: #004085;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #004085;
      border-color: #003366;
    }
    .navbar-brand {
      font-weight: bold;
      letter-spacing: 1px;
    }
    @media (max-width: 992px) {
      .card-body { padding: 1.2rem !important; }
      .card-header h4 { font-size: 1.2rem; }
      .col-md-7.col-lg-6 { max-width: 100%; }
    }
    @media (max-width: 576px) {
      .card { border-radius: 1rem; }
      .card-header { border-radius: 1rem 1rem 0 0 !important; }
      .card-body { padding: 0.7rem !important; }
      .navbar-brand { font-size: 1.3rem; }
    }
  </style>
</head>
<body>
  <!-- Phonk Aura Animated Background -->
  <div class="aura-bg">
    <div class="aura-blob aura-blob1"></div>
    <div class="aura-blob aura-blob2"></div>
    <div class="aura-blob aura-blob3"></div>
    <div class="aura-blob aura-blob4"></div>
    <div class="aura-blob aura-blob5"></div>
    <div class="aura-blob aura-blob6"></div>
  </div>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">Genesis_Coding</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
        aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Add Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="view.php">View Contacts</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main Content -->
  <main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">
        <div class="card">
          <div class="card-header bg-warning text-dark text-center">
            <h4 class="mb-0">Edit Contact</h4>
          </div>
          <div class="card-body">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" novalidate>
              <div class="mb-3">
                <label class="form-label" for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control" value="<?php echo htmlspecialchars($row['subject']); ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="message">Message:</label>
                <textarea id="message" name="message" class="form-control" rows="4" required><?php echo htmlspecialchars($row['message']); ?></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100 fw-semibold">Update</button>
            </form>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="view.php" class="btn btn-link text-decoration-none">Back to List</a>
        </div>
      </div>
    </div>
  </main>
  <footer class="footer mt-5 border-0" style="background:rgba(30,34,43,0.95); box-shadow:0 -2px 16px 0 rgba(0,0,0,0.12);">
    <div class="container text-center py-3">
      <span class="fw-semibold text-info">&copy; 2025 Gen.Tech_Coding</span>
      <span class="mx-2 text-secondary">|</span>
      <span class="text-light">At your service. Be blessed!</span>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>