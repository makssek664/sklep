<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>
<html>
  <body>
    <title>
      Sklep z częściami komputerowymi oraz sprzętem sieciowym.
    </title>
  </body>
</html>
