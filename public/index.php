<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/csrf.php';
require_once __DIR__ . '/../src/common.php';
?>

<body>
  <h1 class="head">
    Sklep z częściami komputerowymi  
  </h1>
  <?php
  if(!isLoggedIn()) {?> 
    <a href="login.php">Zaloguj sie</a>
  <?php } ?>
</body>
