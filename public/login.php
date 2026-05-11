<?php
session_start();

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/csrf.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrfVerify($_POST['csrf'] ?? '')) {
        die('CSRF validation failed');
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($email, $password)) {
        header('Location: dashboard.php');
        exit;
    }

    $error = 'Nieprawidłowe hasło lub email.';
}

$token = csrfToken();
?>

<h2>Login</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Haslo</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>
    lub <a href="register.php">zarejestruj sie</a>.
    Nie pamiętasz hasła? <a href="reset.php">zresetuj je</a>.
</p>
