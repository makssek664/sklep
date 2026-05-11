<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>

<title>
  Sklep z częściami komputerowymi oraz sprzętem sieciowym.
</title>
