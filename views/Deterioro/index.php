<div class="jumbotron mt-3 py-0">
  <h1 class="display-4 font-weight-bold text-center">Deteriorios</h1>
</div>
<!-- filtro buscar -->
<div class="row my-3 ">
  <div class="ml-3">
    <div class="mt-2 font-weight-bold">Buscar:</div>
  </div>
  <div class="col-sm-3">
    <input id="buscar" class="form-control" type="text" name="buscar" placeholder="Buscar" value="">
  </div>
  <div class="col-sm-8">
    <a class="btn btn-success float-right font-weight-bold" type="button"
    href="<?=getUrl("Deterioro","Deterioro","getCreate") ?>" >Registrar</a>
  </div>
</div>
<!-- fin filtro buscar -->

<!-- tabla Deterioro -->
<table class="table table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Descripcion</th>
      <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($deterioro=pg_fetch_assoc($deterioros)): ?>
      <tr>
        <td class="text-center"><?=$deterioro['det_id']?></td>
        <td class="text-center"><?=$deterioro['det_nombre']?></td>
        <td class="text-center"><?=$deterioro['det_descripcion']?></td>
        <td class="text-center">
          <a href="<?=getUrl("Deterioro","Deterioro","getUpdate",$deterioro) ?>" class="btn btn-success btn-round btn-sm" name="button">Editar</a>
          <a href="<?=getUrl("Deterioro","Deterioro","getDelete",$deterioro) ?>" class="btn btn-danger btn-round btn-sm" name="button">Erradicar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>

</table>
<!-- fin tabla Deterioro -->
<!-- nav paginador -->

<div class="float-right">
  <nav aria-label="Page navigation example" class="bd-dark">
    <ul class="pagination"  >
      <li class="page-item">
        <a class="page-link Previous" aria-label="Previous" valor="1"
        url-data="<?=$urlPaginador?>"
        >
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
          >
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>
<!-- fin nav paginador -->
