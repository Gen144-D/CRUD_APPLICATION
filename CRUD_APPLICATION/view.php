<?php

// Connection to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdemo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM contacts");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact List - Genesis_Coding</title>
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
    /* Aura/Phonk-inspired animated blobs background */
    .aura-bg {
      position: fixed;
      top: 0; left: 0; width: 100vw; height: 100vh;
      z-index: 0;
      pointer-events: none;
      overflow: hidden;
    }
    .aura-blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      opacity: 0.85;
      animation: auraFloat 18s ease-in-out infinite alternate;
      mix-blend-mode: lighten;
      transition: opacity 0.5s;
    }
    .aura-blob1 {
      width: 600px; height: 600px;
      background: radial-gradient(circle, #ff6fd8 0%, #3813c2 80%);
      left: -180px; top: -160px;
      animation-delay: 0s;
    }
    .aura-blob2 {
      width: 500px; height: 500px;
      background: radial-gradient(circle, #fbc2eb 0%, #fad0c4 80%);
      right: -160px; top: 120px;
      animation-delay: 4s;
    }
    .aura-blob3 {
      width: 420px; height: 420px;
      background: radial-gradient(circle, #43e97b 0%, #38f9d7 80%);
      left: 35vw; bottom: -100px;
      animation-delay: 8s;
    }
    .aura-blob4 {
      width: 350px; height: 350px;
      background: radial-gradient(circle, #f7971e 0%, #ffd200 80%);
      right: 10vw; bottom: -80px;
      animation-delay: 12s;
    }
    .aura-blob5 {
      width: 320px; height: 320px;
      background: radial-gradient(circle, #fd6e6a 0%, #ffc371 80%);
      left: 60vw; top: 10vh;
      animation-delay: 2s;
    }
    .aura-blob6 {
      width: 300px; height: 300px;
      background: radial-gradient(circle, #43cea2 0%, #185a9d 80%);
      left: 70vw; bottom: 10vh;
      animation-delay: 6s;
    }
    @keyframes auraFloat {
      0%   { transform: scale(1) translateY(0) translateX(0);}
      50%  { transform: scale(1.12) translateY(60px) translateX(40px);}
      100% { transform: scale(1) translateY(0) translateX(0);}
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
      .col-md-10 { max-width: 100%; }
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
  <!-- Aura Animated Background -->
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
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main Content -->
  <main class="container my-5 flex-grow-1">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Contact List</h4>
          </div>
          <div class="card-body">
            <?php if ($result && $result->num_rows > 0): ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle bg-white">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                        <td>
                          <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="alert alert-info">No contacts found.</div>
            <?php endif; ?>
            <?php $conn->close(); ?>
          </div>
        </div>
        <div class="text-center mt-4">
          <a href="index.html" class="btn btn-link text-decoration-none">Add New Contact</a>
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