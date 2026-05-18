<?php
session_start();

if(!isLoggedIn() || !isAdmin()) {
  header('Location: index.php');
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
