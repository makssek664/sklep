<?php
session_start();

require_once __DIR__ . '/../../src/auth.php';
require_once __DIR__ . '/../../src/csrf.php';
require_once __DIR__ . '/../../src/db.php';

$error = '';

if(!isLoggedIn() || !isAdmin()) {
  header('Location: index.php');
  exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!csrfVerify($_POST['csrf'] ?? '')) {
    die('CSRF failed');
  }
  
  $email = trim($_POST['email']) ?? '';
  $password = $_POST['password'] ?? '';
  $type = $_POST['role'];
  if(!$email || !$password) {
      $error = "Puste pole(a)"; 
  } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("
        INSERT INTO users (email, password, type)
        VALUES (?, ?, ?)
      ");
      $stmt->execute([$email, $hash, $type]);
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit;
  }
}



$token = csrfToken();

$stmt = $pdo->prepare('SELECT * FROM `users`');
$stmt->execute();
echo '<ul>';
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $col) {
  /// TODO: add REMOVE button
  echo '<li>' . $col['email'] . ', ' . $col['type'] . '</li>'; 
  
}
echo '</ul>';

?>

<form method="POST">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
    <input type="email" name="email" placehold="Email" required><br><br>
    <input type="password" name="password" placeholder="Haslo" required><br><br>
    <label>
        <input type="radio" name="role" value="admin"> 
        Admin
    </label>
    <label>
        <input type="radio" name="role" value="manager">
        Manager 
    </label>
    <label>
        <input type="radio" name="role" value="supplier">
        Supplier 
    </label>
    <label>
        <input type="radio" name="role" value="client">
        Client 
    </label>
    
  <button type="submit">Zastosuj</button>
</form>

