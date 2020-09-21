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
              <input  id="tip_pav_id" type="hidden" name="tip_pav_id" value="">
              <label for="tip_pav_nombre">Nombre</label>
              <input id="tip_pav_nombre" class="form-control form-modal validar focus"
                placeholder="Ingrese un nombre por favor" type="text" name="tip_pav_nombre" value="" >
              <span class="text-danger tip_pav_nombre" for="tip_pav_nombre"></span>
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