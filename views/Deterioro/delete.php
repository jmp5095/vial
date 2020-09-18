<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Eliminar Deterioro con id <?=$det_id?></h1>
</div>
    <form class="form" action="<?=getUrl("Deterioro","Deterioro","postDelete")?>" method="post">
      <div class="form-group">
        <input type="hidden" name="tip_pav_id" value="<?=$det_id?>">
        <label class="font-weight-bold" for="det_nombre">Nombre</label>
        <input type="text" class="form-control" placeholder="Ingrese el tipo de deterioro" name="det_nombre"
        value="<?=$det_nombre?>" disabled >
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Eliminar">
        <a href="<?=getUrl("Deterioro","Deterioro","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
