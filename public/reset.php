<?php
require_once __DIR__ . '/../src/csrf.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(!csrfVerify($_POST['csrf'] ?? '')) {
    die('CSRF validation failed');
  }

  $email = $_POST['email'] ?? '';
  $newpass = $_POST['newpass'] ?? '';

  if(!$email || !$newpass) {
    $error = "Puste pole(a)";
    return;  
  }
  
  try {
    resetPassword($email, $newpass);
  } catch (PDOException $e) {
    $error = "Nie udało sie zresetować hasła.";    
  }
}

$token = csrfToken();

?>

<?php if($error): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="newpass" placeholder="Haslo" required><br><br>

    <button type="submit">Zresetuj hasło</button>

</form>
