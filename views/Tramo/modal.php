
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
              <input  id="tra_id" type="hidden" name="bar_id" value="">
              <label for="tra_codigo">Codigo</label>
              <input id="tra_codigo" class="form-control form-modal validar focus"  type="text" name="tra_codigo" value="" >
              <span class="text-danger tra_codigo" for="tra_codigo"></span>
            </div>
            <div class="form-group">
              <label for="id_barrio">Barrio</label>
              <select id="id_barrio" class="form-control" name="id_barrio">

              </select>
              <span class="text-danger id_barrio" for="id_barrio"></span>
            </div>
            <div class="form-group">
              <label for="id_tipo_pavimento">Tipo de pavimento</label>
              <select id="id_tipo_pavimento" class="form-control" name="id_tipo_pavimento">

              </select>
              <span class="text-danger id_tipo_pavimento" for="id_tipo_pavimento"></span>
            </div>
            <div class="form-group">
              <label for="id_elemento_complementario">Elemento complementario</label>
              <select id="id_elemento_complementario" class="form-control" name="id_elemento_complementario">

              </select>
              <span class="text-danger id_elemento_complementario" for="id_elemento_complementario"></span>
            </div>
            <div class="form-group">
              <label for="">Entornos</label><br>
              <div class="" >
                <table id="tableEnt">

                </table>
              </div>
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
