<?php
require_once(__DIR__ . '/../includes/db.php');

class User {
    public static function register($username, $email, $password_hash) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password)");
        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password_hash
        ]);
    }

    public static function findByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
