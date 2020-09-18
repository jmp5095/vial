<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Insertar Deterioro</h1>
</div>

<?php include_once "../views/helpers/errorMsg.php"?>

    <form class="form" action="<?=getUrl("Deterioro","Deterioro","postCreate")?>" method="post" onsubmit="return true">
      <div class="form-group">
        <label class="font-weight-bold" for="det_nombre">Nombre</label>
        <input id="det_nombre" type="text" class="form-control validar" placeholder="Ingrese el tipo de deterioro" name="det_nombre" >
        <span class="text-danger det_nombre" for="det_nombre"></span>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="det_descripcion">Descripcion</label>
        <textarea id="det_descripcion" type="text" class="form-control validar" placeholder="Ingrese la descripcion del deterioro" name="det_descripcion" ></textarea>
        <span class="text-danger det_descripcion"  for="det_descripcion"></span>
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
        <a href="<?=getUrl("Deterioro","Deterioro","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
