$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  noPaste('det_nombre');
  noPaste('det_descripcion');
  //TOASTR PERSONALIZADO
  let opc=myToastr();
  toastr.options=opc;

  // MODAl, ESTO MUESTRA EL MODAL
  $(document).on("click","#accionarModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');

    if(accion=="registrar"){
      $('#titulo').html('Registrar deterioro');
      $('#det_nombre').val('');
      $('#det_descripcion').val('');


      prepararCampo('det_nombre');
      prepararCampo('det_descripcion');
    }
    if(accion=="actualizar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      let descripcion=$(this).attr('data-descripcion');
      $('#titulo').html('Actualizar deterioro id '+id);
      $('#det_id').val(id);
      $('#det_nombre').val(nombre);
      $('#det_descripcion').val(descripcion);

      prepararCampo('det_nombre');
      prepararCampo('det_descripcion');
    }
    if(accion=="eliminar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      let descripcion=$(this).attr('data-descripcion');

      $('#titulo').html('Eliminar deterioro id '+id);
      $('#det_id').val(id);
      $('#det_nombre').val(nombre);
      $('#det_descripcion').val(descripcion);

      prepararCampo('det_nombre');
      prepararCampo('det_descripcion');
      $('#det_nombre').attr('disabled','true');
      $('#det_descripcion').attr('disabled','true');
    }
    // data del boton modal
    $('#btnModal').attr('accion',accion);
    $('#btnModal').attr('data-url',url);
    $('#btnModal').attr('data-dismiss','');
  });
  // FIN MODAL ESTO MUESTRA EL MODAL
  // BOTON DEL MODAL
  $(document).on("click","#btnModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');
    let auxValido= false;
    if (accion=="registrar") {
      //validamos que no este vacio
      let  nombre=$('#det_nombre').val().trim();
      let  descripcion=$('#det_descripcion').val().trim();

      if (validarCampo('det_nombre',nombre) && validarCampo('det_descripcion',descripcion)) {
        auxValido=true;
        datos={
          det_nombre:nombre,
          det_descripcion:descripcion,
        }
      }
    }
    if (accion=="actualizar") {
      //validamos que no este vacio
      let  id=$('#det_id').val();
      let  nombre=$('#det_nombre').val().trim();
      let  descripcion=$('#det_descripcion').val().trim();
      if (validarCampo('det_nombre',nombre) && validarCampo('det_descripcion',descripcion)) {
        auxValido=true;
        datos={
          det_id:id,
          det_nombre:nombre,
          det_descripcion:descripcion
        }
      }
    }
    if (accion=="eliminar") {
      auxValido=true;
      let id=$('#det_id').val();
      datos={
        det_id:id
      }
    }

    if (auxValido) {
      $.ajax({
        type:'POST',
        url:url,
        data:datos,
        success:function(resp){
          let typeMsg;
          let msg=JSON.parse(resp);
          let titleMsg;
          if (msg['errorMsg']) {
            typeMsg="error";
            msg=msg['errorMsg'];
            titleMsg="Algo salio mal";
          }else{
            typeMsg="success";
            msg=msg['successMsg'];
            titleMsg="Todo en orden";
          }

          if (accion=="registrar") {
            toastr[typeMsg](msg,titleMsg);
          }
          if (accion=="actualizar") {
            toastr[typeMsg](msg,titleMsg);

          }
          if (accion=="eliminar") {
            toastr[typeMsg](msg,titleMsg);
          }

          $('#modal').modal('hide');
        }

      });
    }


  });
  //FIN BOTON DEL MODAL

  // PAGINACION
  let idioma=idiomaDataTable();
  let table = $('#myTable').DataTable({
    "language":idioma
  });

  $(document).on('click','#myTableBtn', (arguments) => {

  })
  //FIN PAGINACION


});
