<?php include 'db.php'; include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title && $content) {
        $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
        header("Location: posts.php");
        exit();
    } else {
        echo "<div class='alert alert-warning'>All fields required.</div>";
    }
}
?>

<h3>Add New Post</h3>
<form method="POST" class="w-50">
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control" required></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>

<?php include 'footer.php'; ?>
