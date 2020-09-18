<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Eliminar Barrio con id <?=$bar_id?></h1>
</div>
<?php
            while ($bar=pg_fetch_assoc($barrios)){
?>
<form action="<?php echo getUrl("Barrio","Barrio","postDelete"); ?>" method="post">
  <div class="form-group">
      <label>Nombre</label>
      <input type="hidden" name="bar_id" value="<?=$bar_id?>">
      <input type="text" class="form-control validar" placeholder="Ingrese el nómbre del Barrio" name="bar_nombre" value="<?=$bar_nombre?>" disabled >
  </div>
  <div class="form-group">
      <label>comuna</label>
      <input type="text" readonly class="form-control" name="com_nombre" value="<?php echo $bar['com_nombre']?>" maxlength="30">
  </div>
  <div class="form-group">
    <input class="btn btn-success" type="submit" name="Enviar" value="Eliminar">
    <a href="<?=getUrl("Barrio","Barrio","index")?>" class="btn btn-danger">Cancelar</a>
  </div>
</form>
<?php
    }
?>
