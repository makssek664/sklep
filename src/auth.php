<?php

require_once __DIR__ . '/db.php';

function login(string $email, string $password): bool
{
    global $pdo;

    $stmt = $pdo->prepare(
        "SELECT id, password FROM users WHERE email = :email"
    );

    $stmt->execute([
        'email' => $email
    ]);

    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['password'])) {
        return false;
    }

    $_SESSION['user_id'] = $user['id'];

    return true;
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function resetPassword(string $email, string $newpass): void
{
  global $pdo;
  
  $stmt = $pdo->prepare(
    "UPDATE users SET password = :password WHERE email = :email"  
  );
  
  $stmt->execute([
    'email' => $email,
    'password' => password_hash($newpass, PASSWORD_DEFAULT)  
  ]);
}

?>
