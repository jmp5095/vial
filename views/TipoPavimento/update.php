<div class="jumbotron  mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Actualizar Tipo Pavimento</h1>
</div>

    <form class="form" action="<?=getUrl("TipoPavimento","TipoPavimento","postUpdate")?>" method="post">
      <div class="form-group">
        <label class="font-weight-bold" for="tip_pav_nombre">Nombre</label>
        <input type="hidden" name="tip_pav_id" value="<?=$tip_id?>">
        <input type="hidden" name="tip_nombre_actual" value="<?=$tip_nombre?>">
        <input type="text" class="form-control validar" id="tip_pav_nombre" placeholder="Ingrese en nómbre de Tipo Pavimento"
        name="tip_pav_nombre" value="<?=$tip_nombre?>"  >
        <span class="text-danger tip_pav_nombre" for="tip_pav_nombre"></span>
      </div>
      <div class="form-group">
        <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
        <a href="<?=getUrl("TipoPavimento","TipoPavimento","index")?>" class="btn btn-danger">Cancelar</a>
      </div>
    </form>
