<nav class="navbar">
    <ul>
        <li><a href="about.php">About Me</a></li>
        <li><a href="activities.php">My Activities</a></li>
        <li><a href="education.php">My Education</a></li>
        <li><a href="qualification.php">My Qualification</a></li>
        <li><a href="interests.php">My Interest</a></li>
        <?php if (isset($_SESSION['admin'])) { ?>
            <li><a href="admin/dashboard.php">⚙️ Admin Dashboard</a></li>
        <?php } ?>
    </ul>
</nav>



