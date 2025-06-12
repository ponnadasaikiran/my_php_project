<?php include 'db.php'; include 'header.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT title, content FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $content);
$stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_title, $new_content, $id);
    $stmt->execute();
    header("Location: posts.php");
    exit();
}
?>

<h3>Edit Post</h3>
<form method="POST" class="w-50">
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($title) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control" required><?= htmlspecialchars($content) ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'footer.php'; ?>
