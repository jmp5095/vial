$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  noPaste('com_nombre');
  //TOASTR PERSONALIZADO
  let opc=myToastr();
  toastr.options=opc;

  // MODAl, ESTO MUESTRA EL MODAL
  $(document).on("click","#accionarModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');

    if(accion=="registrar"){
      $('#titulo').html('Registrar comuna');
      $('#com_nombre').val('');


      prepararCampo('com_nombre');
    }
    if(accion=="actualizar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      $('#titulo').html('Actualizar comuna id '+id);
      $('#com_id').val(id);
      $('#com_nombre').val(nombre);

      prepararCampo('com_nombre');
    }
    if(accion=="eliminar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      $('#titulo').html('Eliminar comuna id '+id);
      $('#com_id').val(id);
      $('#com_nombre').val(nombre);

      prepararCampo('com_nombre');
      $('#com_nombre').attr('disabled','true');
    }
    // data del boton modal
    $('#btnModal').attr('accion',accion);
    $('#btnModal').attr('data-url',url);
  });
  // FIN MODAL ESTO MUESTRA EL MODAL
  // BOTON DEL MODAL
  $(document).on("click","#btnModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');
    let auxValido= false;
    if (accion=="registrar") {
      //validamos que no este vacio
      let  nombre=$('#com_nombre').val().trim();

      if (validarCampo('com_nombre',nombre)) {
        auxValido=true;
        datos={
          com_nombre:nombre
        }
      }
    }
    if (accion=="actualizar") {
      //validamos que no este vacio
      let  id=$('#com_id').val();
      let  nombre=$('#com_nombre').val().trim();
      if (validarCampo('com_nombre',nombre)) {
        auxValido=true;
        datos={
          com_id:id,
          com_nombre:nombre
        }
      }
    }
    if (accion=="eliminar") {
      auxValido=true;
      let id=$('#com_id').val();
      datos={
        com_id:id
      }
    }

    if (auxValido) {
      $.ajax({
        type:'POST',
        url:url,
        data:datos,
        success:function(resp){
          $('tbody').html(resp);

        }

      });

      $('#modal').modal('hide');
      if (accion=="registrar") {
        toastr["success"]("Registro exitoso!","todo en orden");
      }
      if (accion=="actualizar") {
        toastr["success"]("Actualizacion exitosa!","todo en orden");

      }
      if (accion=="eliminar") {
        toastr["success"]("Eliminacion exitosa!","todo en orden");
      }


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
