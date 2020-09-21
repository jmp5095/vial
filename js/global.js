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

let noPaste=(id)=>{
  $("#"+id).on('paste', function(e){
    e.preventDefault();
    toastr['warning']("Esta accion no esta permitida","Alerta!");
  });
}

let myToastr=()=>{
  return {
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
}
let idiomaDataTable=()=>{
  return{
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
}
let getUrl=(modulo,controlador,funcion,parametro=false,pagina=false)=>{
  if (!pagina) {
    pagina="index";
  }
  let url=`${pagina}.php?modulo=${modulo}&controlador=${controlador}&funcion=${funcion}`;

  if (parametro) {
    parametro.forEach((item, i) => {
      url+=`&${item.key}=${item.value}`;
    });

  }

  return url;
}

let crearTabla=()=>{
  let idioma=idiomaDataTable();
  return $('#myTable').DataTable({
    "language":idioma
  });
}
