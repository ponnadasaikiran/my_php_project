<?php include 'db.php'; include 'header.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Pagination setup
$limit = 5; // posts per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search setup
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = $search ? "WHERE title LIKE ? OR content LIKE ?" : '';
$countStmt = $conn->prepare("SELECT COUNT(*) FROM posts $searchSql");

if ($search) {
    $likeSearch = "%$search%";
    $countStmt->bind_param("ss", $likeSearch, $likeSearch);
}
$countStmt->execute();
$countStmt->bind_result($totalPosts);
$countStmt->fetch();
$countStmt->close();

$totalPages = ceil($totalPosts / $limit);

// Fetch posts with search + pagination
$postStmt = $conn->prepare("SELECT * FROM posts $searchSql ORDER BY created_at DESC LIMIT ?, ?");
if ($search) {
    $postStmt->bind_param("ssii", $likeSearch, $likeSearch, $start, $limit);
} else {
    $postStmt->bind_param("ii", $start, $limit);
}
$postStmt->execute();
$result = $postStmt->get_result();
?>

<h3>All Posts</h3>

<form method="GET" class="mb-3 d-flex" style="max-width: 400px;">
    <input type="text" name="search" class="form-control me-2" value="<?= htmlspecialchars($search) ?>" placeholder="Search posts...">
    <button class="btn btn-outline-primary">Search</button>
</form>

<a href="add_post.php" class="btn btn-success mb-3">+ Add Post</a>

<table class="table table-striped">
  <tr>
    <th>Title</th><th>Content</th><th>Date</th><th>Actions</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</td>
    <td><?= $row['created_at'] ?></td>
    <td>
      <a href="edit_post.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
      <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete post?')" class="btn btn-danger btn-sm">Delete</a>
      <?php endif; ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<!-- Pagination links -->
<nav>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $i == $page ? 'active' : '' ?>">
        <a class="page-link" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>

<?php include 'footer.php'; ?>
