<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/csrf.php';
?>

<body>
  <h1>
    Sklep z częściami komputerowymi  
  </h1>
  <?php
  if(!isLoggedIn()) {?> 
    <a href="login.php">Zaloguj sie</a>
  <?php } ?>
</body>
