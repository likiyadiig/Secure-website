<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once('../models/User.php');
include('../includes/header.php');

// Get user info from DB
$user = User::findById($_SESSION['user_id']);
?>

<h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

<p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
<p><strong>Registered on:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>

<a href="logout.php">Logout</a>

<?php include('../includes/footer.php'); ?>
