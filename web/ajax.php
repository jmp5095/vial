<?php
include_once '../lib/helpers.php';
if ($_GET['modulo']) {
  resolve();
}else{
  include_once '../views/partials/content.php';
}
 ?>
