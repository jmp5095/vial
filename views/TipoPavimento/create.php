<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Insertar Tipo Pavimento</h1>
</div>

<?php include_once '../views/helpers/errorMsg.php'?>

    <form class="form" action="<?=getUrl("TipoPavimento","TipoPavimento","postCreate")?>" method="post" onsubmit="return true">
      <div class="form-group">
        <label class="font-weight-bold" for="com_nombre">Nombre</label>
        <input  type="text" class="form-control validar" id="tip_pav_nombre" placeholder="Ingrese el nómbre del tipo Pavimento"
        name="tip_pav_nombre" >
        <span class="text-danger tip_pav_nombre" for="tip_pav_nombre"></span>
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
        <a href="<?=getUrl("TipoPavimento","TipoPavimento","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
