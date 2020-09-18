<?php if (isset($_SESSION['error'])): ?>

  <div class="alert alert-danger" role="alert">
    <?php foreach ($_SESSION['error'] as $key => $value): ?>
      <span class="text-danger"><?=$value?></span><br>
    <?php endforeach; ?>
  </div>

  <?php unset($_SESSION['error']);?>

<?php endif; ?>
