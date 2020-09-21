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
              <input  id="ele_com_id" type="hidden" name="ele_com_id" value="">
              <label for="ele_com_descripcion">Descripcion</label>
              <input id="ele_com_descripcion" class="form-control form-modal validar focus"
                placeholder="Ingrese un nombre por favor" type="text" name="ele_com_descripcion" value="" >
              <span class="text-danger ele_com_descripcion" for="ele_com_descripcion"></span>
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
