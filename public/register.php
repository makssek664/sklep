<?php
session_start();

require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../src/csrf.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrfVerify($_POST['csrf'] ?? '')) {
        die('CSRF failed');
    }

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $error = "Puste pole(a)";
    } else {

        // hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("
                INSERT INTO users (email, password, admin)
                VALUES (?, ?, 0)
            ");
            $stmt->execute([$email, $hash]);

            header('Location: login.php');
            exit;

        } catch (PDOException $e) {
            $error = "Użytkownik istnieje, lub błąd baz danych.";
        }
    }
}

$token = csrfToken();
?>

<h2>Zarejestruj sie</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Haslo" required><br><br>

    <button type="submit">Zarejestruj sie</button>

</form>
