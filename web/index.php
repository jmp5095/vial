<?php
include_once '../lib/helpers.php';
include_once '../views/partials/header.php';
echo "<body>";
  echo "<div class='wrapper'>";
    include_once '../views/partials/navbar.php';
    include_once '../views/partials/sidebar.php';

    echo "<div class='main-panel'>";
      echo "<div class='content'>";
        echo "<div class='container'>";
          if (isset($_GET['modulo'])) {
            resolve();
          }else{
            include_once '../views/partials/content.php';
          }
        echo "</div>";
      echo "</div>";
      include_once '../views/partials/final.php';
    echo "</div>";
  echo "</div>";
  include_once '../views/partials/footer.php';
echo "</body>";
echo "</html>";
 ?>
