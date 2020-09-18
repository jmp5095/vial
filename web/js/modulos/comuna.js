$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  $("#com_nombre").on('paste', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida');
  });
  // MENSAJES DE LAERTA
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
  // FUNCIONES
  let prepararCampos=()=>{
    $('#com_nombre').removeAttr('disabled');
    $('#com_nombre').removeClass('is-valid');
    $('#com_nombre').removeClass('is-invalid');
    $('span.com_nombre').html('');
  }
  let validarCampo=(id,campo)=>{
    campo=campo.trim();
    if ($('span.'+id).hasClass('caracter') | $('span.'+id).hasClass('vacio') | campo=="") {
      $('#'+id).removeClass('is-valid');
      $('#'+id).addClass('is-invalid');
      if ($('span.'+id).hasClass('caracter')) {
        $('span.'+id).html('No ingrese caracteres especiales')
      }else{
        $('span.'+id).html('El campo no puede estar vacio')
      }
      return false;
    }else{
      return true;
    }
  }
  // MODAl, ESTO MUESTRA EL MODAL
  $(document).on("click","#accionarModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');

    if(accion=="registrar"){
      $('#titulo').html('Registrar comuna');
      $('#com_nombre').val('');


      prepararCampos();
    }
    if(accion=="actualizar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      $('#titulo').html('Actualizar comuna id '+id);
      $('#com_id').val(id);
      $('#com_nombre').val(nombre);

      prepararCampos();
    }
    if(accion=="eliminar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      $('#titulo').html('Eliminar comuna id '+id);
      $('#com_id').val(id);
      $('#com_nombre').val(nombre);

      prepararCampos();
      $('#com_nombre').attr('disabled','true');
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
  let idioma={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "<strong class='font-weight-bold h4'>Registros por página<strong> _MENU_",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "<span class='h4'>Registros del _START_ al _END_ </span> <br /> <b class='h1 font-weight-bold'>Total:</b> <span class='h4'> _TOTAL_ registros </span'>",
    "sInfoEmpty":      "Registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "<strong class='font-weight-bold h4'>Buscar:</strong>",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     ">>",
      "sPrevious": "<<"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
      "copy": "Copiar",
      "colvis": "Visibilidad"
    }
  }
  let table = $('#myTable').DataTable({
    "language":idioma
  });

  $(document).on('click','#myTableBtn', (arguments) => {

  })
  //FIN PAGINACION


});
