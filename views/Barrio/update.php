<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold">Actualizar Barrio</h1>
</div>

  <form class="form" action="<?=getUrl("Barrio","Barrio","postUpdate")?>" method="post">
    <div class="form-group">
      <input type="hidden" name="bar_id" value="<?=$bar_id?>" >
      <label class="font-weight-bold" for="com_nombre">Nombre</label>
      <input class="form-control validar" id="bar_nombre" type="text"  placeholder="Ingrese el nómbre del Barrio"
      name="bar_nombre" value="<?=$bar_nombre?>">
      <span class="text-danger bar_nombre" for="bar_nombre"></span>
    </div>

    <div class="form-group">
      <label class="font-weight-bold" for="com_id">Comuna</label>
      <select class="form-control" name="com_id" id="com_id">
        <?php
        while($comu=pg_fetch_assoc($comuna)){
          if($comu['com_id']==$com_id){
            echo "<option value='".$comu['com_id']."'selected>".$comu['com_nombre']."</option>";

          }else{
            echo "<option value='".$comu['com_id']."'>".$comu['com_nombre']."</option>";
          }
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <input class="btn btn-success" type="submit" name="Enviar" value="Enviar">
      <a href="<?=getUrl("Barrio","Barrio","index")?>" class="btn btn-danger">Cancelar</a>
    </div>
  </form>
