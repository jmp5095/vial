
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="titulo"> </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- //////// -->
        <div class="modal-body">
            <div class="form-group">
              <input  id="bar_id" type="hidden" name="bar_id" value="">
              <label for="bar_nombre">Nombre</label>
              <input id="bar_nombre" class="form-control form-modal validar focus"  type="text" name="bar_nombre" value="" >
              <span class="text-danger bar_nombre" for="bar_nombre"></span>
            </div>
            <div class="form-group">
              <label for="id_comuna">Comuna</label>
              <select id="id_comuna" class="form-control" name="id_comuna" disabled="true">

              </select>
              <span class="text-danger id_comuna" for="id_comuna"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <input id="btnModal" type="button" class="btn btn-success" value="Enviar"></input>
        </div>
    <!-- ////// -->
    </div>
  </div>
</div>
