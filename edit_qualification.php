<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM qualifications WHERE id=$id");
$qual = mysqli_fetch_assoc($result);
$message = "";

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $institution = mysqli_real_escape_string($conn, $_POST['institution']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    if ($title && $institution && $year) {
        mysqli_query($conn, "UPDATE qualifications SET title='$title', institution='$institution', year='$year' WHERE id=$id");
        $message = "✅ Qualification updated!";
        $result = mysqli_query($conn, "SELECT * FROM qualifications WHERE id=$id");
        $qual = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Qualification</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Edit Qualification</h1>
    <?php if ($message) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($qual['title']); ?>" required><br><br>
        <label>Institution:</label><br>
        <input type="text" name="institution" value="<?php echo htmlspecialchars($qual['institution']); ?>" required><br><br>
        <label>Year:</label><br>
        <input type="text" name="year" value="<?php echo htmlspecialchars($qual['year']); ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../qualification.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
