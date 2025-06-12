<?php include 'db.php'; include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<div class='alert alert-danger'>All fields required.</div>";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        echo "<div class='alert alert-warning'>Username invalid.</div>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'editor')");
        if (!$stmt) {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        } else {
            $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            echo "<div class='alert alert-success'>Registered! <a href='login.php'>Login</a></div>";
        }
    }
}
?>

<h3>Register</h3>
<form method="POST" class="w-50">
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php include 'footer.php'; ?>