<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "../includes/db_connect.php";

$message = "";

// Add Education
if (isset($_POST['add'])) {
    $school = mysqli_real_escape_string($conn, $_POST['school_name']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    if (!empty($school) && !empty($qualification) && !empty($year)) {
        mysqli_query($conn, "INSERT INTO education (school_name, qualification, year) VALUES ('$school','$qualification','$year')");
        $message = "✅ Education record added!";
    } else {
        $message = "⚠️ Please fill in all fields.";
    }
}

// Delete Education
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM education WHERE id=$id");
    $message = "🗑️ Education record deleted!";
}

// Fetch Education
$result = mysqli_query($conn, "SELECT * FROM education ORDER BY year DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Education</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Manage Education</h1>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <label>School/University:</label><br>
        <input type="text" name="school_name" required><br><br>

        <label>Qualification:</label><br>
        <input type="text" name="qualification" required><br><br>

        <label>Year:</label><br>
        <input type="text" name="year" required><br><br>

        <button type="submit" name="add">Add Education</button>
    </form>

    <hr>
    <h2>Existing Education</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li>
                <b><?php echo htmlspecialchars($row['school_name']); ?></b> - 
                <?php echo htmlspecialchars($row['qualification']); ?> (<?php echo htmlspecialchars($row['year']); ?>)<br>
                <a href="edit.education.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="manage_education.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
            </li>
        <?php } ?>
    </ul>

    <p style="margin-top:20px;">
        <a href="dashboard.php">← Back to Dashboard</a> | 
        <a href="../education.php" target="_blank">🌐 View Public Page</a>
    </p>
</body>
</html>
