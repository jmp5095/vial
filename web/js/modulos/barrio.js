$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  $("#bar_nombre").on('paste', function(e){
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
  let prepararCampo=(id)=>{
    $('#'+id).removeAttr('disabled');
    $('#'+id).removeClass('is-valid');
    $('#'+id).removeClass('is-invalid');
    $('span.'+id).html('');
  }
  let prepararCampoSelect=(id)=>{
    $('#'+id).removeAttr('disabled');
    $('#'+id).removeClass('is-valid');
    $('#'+id).removeClass('is-invalid');
    $('span.'+id).html('');
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
  let validarCampoSelect=(id,valor_id)=>{
    if (valor_id=="") {
      $('#'+id).removeClass('is-valid');
      $('#'+id).addClass('is-invalid');
      $('span.'+id).html('Seleccione una opción');
      return false
    }else{
      $('#'+id).addClass('is-valid');
      $('#'+id).removeClass('is-invalid');
      $('span.'+id).html('');

      return true;
    }
  }

  // MODAl, ESTO MUESTRA EL MODAL
  $(document).on("click","#accionarModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');

    if(accion=="registrar"){
      $('#titulo').html('Registrar barrio');
      $('#bar_nombre').val('');
      let url=$(this).attr('data-url');
      $.ajax({
        type:"POST",
        url:url,
        success:function(resp){
          let comunas=JSON.parse(resp)
          let html=`
          <option value="">Seleccione...</option>
          `
          for (var i = 0; i < comunas.length; i++) {
            html+=`<option value="${comunas[i].com_id}">${comunas[i].com_nombre}</option>`
          }
          $('#id_comuna').html(html);
        }
      });

      prepararCampo('bar_nombre');
      prepararCampoSelect('id_comuna');
    }
    if(accion=="actualizar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      let id_comuna=$(this).attr('data-id-comuna');
      $('#titulo').html('Actualizar barrio id '+id);
      $('#bar_id').val(id);
      $('#bar_nombre').val(nombre);

      let url=$(this).attr('data-url');
      $.ajax({
        type:"POST",
        url:url,
        success:function(resp){
          let comunas=JSON.parse(resp)
          let html=`
          <option value="">Seleccione...</option>
          `
          let selected="";
          for (var i = 0; i < comunas.length; i++) {
            if (id_comuna==comunas[i].com_id) {
              selected="selected";
            }else{
              selected="";
            }
              html+=`<option value="${comunas[i].com_id}" ${selected}>${comunas[i].com_nombre}</option>`
          }
          $('#id_comuna').html(html);
        }
      });

      prepararCampo('bar_nombre');
      prepararCampoSelect('id_comuna');
    }
    if(accion=="eliminar"){
      let id=$(this).attr('data-id');
      let nombre=$(this).attr('data-nombre');
      let comuna=$(this).attr('data-comuna');
      $('#titulo').html('Eliminar barrio id '+id);
      $('#bar_id').val(id);
      $('#bar_nombre').val(nombre);
      $('#com_nombre').html(comuna);

      $('#bar_nombre').attr('disabled','true');
      $('#id_comuna').attr('disabled','true');
    }
    // data del boton modal
    url = $(this).attr('data-url-post');
    $('#btnModal').attr('accion',accion);
    $('#btnModal').attr('data-url-post',url);
    $('#btnModal').attr('data-dismiss','');
  });
  // FIN MODAL ESTO MUESTRA EL MODAL
  // BOTON DEL MODAL
  $(document).on("click","#btnModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url-post');
    let auxValido= false;
    if (accion=="registrar") {
      //validamos que no este vacio
      let  nombre=$('#bar_nombre').val().trim();
      let  id=$('#id_comuna').val();

      if (validarCampo('bar_nombre',nombre) && validarCampoSelect('id_comuna',id)) {
        console.log("es valido")
        auxValido=true;
        datos={
          bar_nombre:nombre,
          id_comuna:id
        }
      }
    }
    if (accion=="actualizar") {
      //validamos que no este vacio
      let  id=$('#bar_id').val();
      let  nombre=$('#bar_nombre').val().trim();
      let  id_comuna=$('#id_comuna').val();
      if (validarCampo('bar_nombre',nombre) && validarCampoSelect('id_comuna',id_comuna)) {
        console.log("es valido")
        auxValido=true;
        datos={
          bar_id:id,
          bar_nombre:nombre,
          id_comuna:id_comuna
        }
      }else{
        console.log("no es valido")
      }
    }
    if (accion=="eliminar") {
      auxValido=true;
      let id=$('#bar_id').val();
      datos={
        bar_id:id
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
          $('#modal').modal('hide');
          if (accion=="registrar") {
            toastr[typeMsg](msg,titleMsg);
          }
          if (accion=="actualizar") {
            toastr[typeMsg](msg,titleMsg);

          }
          if (accion=="eliminar") {
            toastr[typeMsg](msg,titleMsg);
          }
        }

      });




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
