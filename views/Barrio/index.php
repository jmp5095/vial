<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold text-center">Barrios</h1>
</div>
<!-- filtro buscar -->
<div class="row my-3 ">
  <div class="ml-3">
    <div class="mt-2 font-weight-bold">Buscar:</div>
  </div>
  <div class="col-sm-3">
    <input id="buscar" class="form-control" type="text" name="buscar" placeholder="Buscar" value="">
  </div>
  <!-- Button trigger modal -->
  <div class="col-sm-8">
    <button type="button" class="btn btn-success float-right font-weight-bold"
      id="accionarModal"
      data-toggle="modal"
      data-target="#modal"
      accion="Registrar Barrio"
      campos="com_id,com_nombre,id_comuna"
      url-data="<?=getUrl("Barrio","Barrio","postCreate")?>">
      Registrar
    </button>
  </div>
<!-- fin modal -->
</div>
<!-- fin filtro buscar -->

<!-- tabla comuna -->
<table class="table table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Comuna</th>
      <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($barrio=pg_fetch_assoc($barrios)): ?>
      <tr>
        <td class="text-center"><?=$barrio['bar_id']?></td>
        <td class="text-center"><?=$barrio['bar_nombre']?></td>
        <td class="text-center"><?=$barrio['com_nombre']?></td>
        <td class="text-center">
          <a href="<?=getUrl("Barrio","Barrio","getUpdate",$barrio) ?>" class="btn btn-success btn-round btn-sm" name="button">Editar</a>
          <a href="<?=getUrl("Barrio","Barrio","getDelete",$barrio) ?>" class="btn btn-danger btn-round btn-sm" name="button">Erradicar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>

</table>
<!-- fin tabla comuna -->
<!-- nav paginador -->

<div class="float-right">
  <nav aria-label="Page navigation example" class="bd-dark">
    <ul class="pagination"  >
      <li class="page-item">
        <a class="page-link Previous" aria-label="Previous" valor="1"
        url-data="<?=$urlPaginador?>"
        tabla="<?=$tablaPaginador?>">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php $active=1 ?>
      <?php for ($i=1;$i<=$total_paginas;$i++):?>
        <li id='<?="item_".$i?>' class="page-item
        <?php if ($i==$active) {echo "active";}?>">
          <a class="page-link" url-data="<?=$urlPaginador?>" valor="<?=$i?>">
            <?=$i?>
          </a>
        </li>
      <?php endfor; ?>
      <li>
        <a aria-label="Next" class="page-link Next" total_paginas="<?=$total_paginas?>" valor="2"
          url-data="<?=$urlPaginador?>"
          tabla="<?=$tablaPaginador?>">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
<!-- fin nav paginador -->

<?php include_once '../views/Comuna/modal.php'?>
