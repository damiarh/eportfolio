<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

// Fetch current About Me data (assuming only one row in table)
$result = mysqli_query($conn, "SELECT * FROM about_me LIMIT 1");
$about = mysqli_fetch_assoc($result);
$message = "";

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if ($name && $email && $description) {
        mysqli_query($conn, "UPDATE about_me SET name='$name', email='$email', description='$description' WHERE id=" . $about['id']);
        $message = "✅ About Me updated!";
        $result = mysqli_query($conn, "SELECT * FROM about_me LIMIT 1");
        $about = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit About Me</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit About Me</h1>
    <?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($about['name']); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($about['email']); ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required><?php echo htmlspecialchars($about['description']); ?></textarea><br><br>

        <button type="submit" name="update">Update</button>
    </form>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../about.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
