<div class="jumbotron mt-3 py-0  col-sm-10 ml-5">
  <h1 class="display-4 font-weight-bold text-center">Entorno</h1>
</div>
  <!-- Button trigger modal -->
  <div class="col-sm-11">
    <button type="button"
      class="btn btn-success mr-2 float-right font-weight-bold"
      id="accionarModal"
      data-toggle="modal"
      data-target="#modal"
      accion="registrar"
      data-url="<?=getUrl("Entorno","Entorno","postCreate",false,"ajax")?>">
      Registrar
    </button>
  </div>
<!-- fin modal -->
<br><br><br>

<!-- tabla comuna -->
<div class="col-sm-11 ml-2">

<table id="myTable" class="table table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Nombre</th>

      <th class="text-center" style="width:135px">Acciones</th>
    </tr>
  </thead>
  <tbody id="myTBody">
    <?php while ($ent=pg_fetch_assoc($entornos)): ?>
      <tr >
        <td class="text-center"><?=$ent['ent_id']?></td>
        <td class="text-center"><?=$ent['ent_nombre']?></td>

        <td class="text-center">
          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
          accion="actualizar"
          data-id="<?=$ent['ent_id']?>"
          data-nombre="<?=$ent['ent_nombre']?>"

          data-url="<?=getUrl("Entorno","Entorno","postUpdate",false,"ajax")?>">
            Editar
          </a>
          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
          accion="eliminar"
          data-id="<?=$ent['ent_id']?>"
          data-nombre="<?=$ent['ent_nombre']?>"

          data-url="<?=getUrl("Entorno","Entorno","postDelete",false,"ajax")?>">
            Erradicar
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>

</table>
</div>
<!-- fin tabla comuna -->
<!-- modal -->
<?php include_once '../views/Entorno/modal.php'?>

<!-- jquery -->
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<!-- scrips principales -->
<script src="../js/global.js"></script>
<script src="../js/entorno.js"></script>
