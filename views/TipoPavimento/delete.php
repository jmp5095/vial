<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Eliminar Pavimento con id <?=$tip_id?></h1>
</div>
    <form action="<?=getUrl("TipoPavimento","TipoPavimento","postDelete")?>" method="post">
      <div class="form-group">
        <label class="font-weight-bold" for="tip_pav_nombre">Nombre</label>
        <input type="hidden" name="tip_pav_id" value="<?=$tip_id?>">
        <input type="text" class="form-control" placeholder="Ingrese el nómbre de Tipo Pavimento" name="tip_pav_nombre" value="<?=$tip_nombre?>" disabled >
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Eliminar">
        <a href="<?=getUrl("TipoPavimento","TipoPavimento","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
