<?php include 'auth.php'; include 'db.php'; ?>
<h2>Welcome, <?= $_SESSION['user'] ?> | <a href="logout.php">Logout</a></h2>
<a href="create.php">➕ Add New Post</a><hr>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<h3>{$row['title']}</h3>";
    echo "<p>{$row['content']}</p>";
    echo "<small>Posted on: {$row['created_at']}</small><br>";
    echo "<a href='edit.php?id={$row['id']}'>✏️ Edit</a> | ";
    echo "<a href='delete.php?id={$row['id']}'>🗑️ Delete</a>";
    echo "<hr>";
}
?>