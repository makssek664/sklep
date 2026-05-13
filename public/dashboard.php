<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>
<html>
  <body>
    <h1>
      Sklep z częściami komputerowymi oraz sprzętem sieciowym.
    </h1>
  </body>
</html>
