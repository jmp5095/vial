<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Actualizar Deterioro</h1>
</div>

<?php include_once "../views/helpers/errorMsg.php"?>

    <form class="form" action="<?=getUrl("Deterioro","Deterioro","postUpdate")?>" method="post">
      <div class="form-group">
        <label class="font-weight-bold" for="det_nombre">Nombre</label>
        <input type="hidden" name="det_id" value="<?=$det_id?>">
        <input type="hidden" name="det_nombre_actual" value="<?=$det_nombre?>">
        <input type="text" class="form-control validar" id="det_nombre" placeholder="Ingrese el tipo de Deterioro" name="det_nombre" value="<?=$det_nombre?>"  >
        <span class="text-danger det_nombre" for="det_nombre" ></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="det_descripcion">Informacion</label>
        <input type="hidden" name="det_id" value="<?=$det_id?>">
        <input type="hidden" name="det_descripcion_actual" value="<?=$det_descripcion?>">
        <input type="text" class="form-control validar" id="det_descripcion" placeholder="Ingrese la descripcion" name="det_descripcion" value="<?=$det_descripcion?>"  >
        <span class="text-danger det_descripcion" for="det_descripcion"></span>
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
        <a href="<?=getUrl("Deterioro","Deterioro","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
