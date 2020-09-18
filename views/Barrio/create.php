<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Registrar Barrio</h1>
</div>

<?php include_once "../views/helpers/errorMsg.php" ?>

    <form class="form" action="<?=getUrl("Barrio","Barrio","postCreate")?>" method="post" onsubmit="return true">
      <div class="form-group">
        <label class="font-weight-bold" for="com_nombre">Nombre</label>
        <input id="bar_nombre" type="text" class="form-control validar" placeholder="Ingrese el nómbre del Barrio" name="bar_nombre" >
        <span class="text-danger bar_nombre" for="bar_nombre"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="id_comuna">Comuna</label>
        <select name="id_comuna" id="id_comuna" class="form-control">
          <option value="">Seleccione...</option>
            <?php
              while ($comu=pg_fetch_assoc($comunas)){
                echo "<option value='".$comu['com_id']."'>".$comu['com_nombre']."</option>";
              }
            ?>
        </select>
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
        <a href="<?=getUrl("Barrio","Barrio","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
