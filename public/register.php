<?php
require_once('../controllers/AuthController.php');
include('../includes/header.php');

[$errors, $success] = handleRegister();
?>

<h2>Register</h2>

<?php
if (!empty($errors)) {
    echo "<ul class='error'>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul>";
}
if ($success) echo "<p class='success'>$success</p>";
?>

<form method="post">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Register">
</form>

<?php include('../includes/footer.php'); ?>
