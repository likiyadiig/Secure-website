<?php
require_once('../controllers/AuthController.php');
include('../includes/header.php');

$errors = handleLogin(); // Handles login and redirects on success
?>

<h2>Login</h2>

<?php
if (!empty($errors)) {
    echo "<ul class='error'>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul>";
}
?>

<form method="post">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Login">
</form>

<p>Don’t have an account? <a href="register.php">Register here</a>.</p>

<?php include('../includes/footer.php'); ?>
