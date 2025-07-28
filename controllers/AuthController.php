<?php
require_once(__DIR__ . '/../models/User.php');

function handleRegister() {
    $errors = [];
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
            $errors[] = "Invalid username.";
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            $errors[] = "Weak password.";
        }

        if (empty($errors)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                User::register($username, $email, $hash);
                $success = "Registered! <a href='login.php'>Login</a>";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $errors[] = "Email already exists.";
                } else {
                    $errors[] = $e->getMessage();
                }
            }
        }
    }

    return [$errors, $success];
}

function handleLogin() {
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Invalid login.";
        }
    }

    return $errors;
}
