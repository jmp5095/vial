$(document).ready(function(){

  // $(document).on("keyup","#buscar",function(){
  //
  //   var valor=$(this).val();
  //
  //   $.ajax({
  //       url: "../../controller/departamento/filtro.php",
  //       data: "depto="+valor,
  //       type: "GET",
  //       success: function(datos){
  //         $("tbody").html(datos);
  //       }
  //   });
  //
  // });
  // $(document).on("keyup","#ciudadb",function(){
  //
  //   var valor=$(this).val();
  //
  //   $.ajax({
  //       url: "../../controller/ciudad/filtro.php",
  //       data: "valor_input="+valor,
  //       type: "GET",
  //       success: function(datos){
  //         $("tbody").html(datos);
  //       }
  //   });
  //
  // });
  // $(document).on("click","#confirm",function(){
  //   var valor=$(this).val();
  //   var bool=confirm("Seguro de eliminar el dato?");
  //   if(bool){
  //     $.ajax({
  //         url: "../../controller/departamento/eliminar.php",
  //         data: "departamento_id="+valor,
  //         type: "GET",
  //         success: function(datos){
  //           $("tbody").html(datos);
  //         }
  //     });
  //   }
  // });
  // $(document).on("click","#eliminarCiudad",function(){
  //   var valor=$(this).val();
  //   var bool=confirm("Seguro de eliminar el dato?");
  //   if(bool){
  //     $.ajax({
  //         url: "../../controller/ciudad/eliminar.php",
  //         data: "ciudad_id="+valor,
  //         type: "GET",
  //         success: function(datos){
  //           $("tbody").html(datos);
  //         }
  //     });
  //   }
  // });
// VALIDAR CAMPOS
  $(document).on("keyup",".validar",function(){
    var cadena=$(this).val();
    var cont=0;
    var noValido='°!"#$|<>_%&/()=@?¡¿"[]*^{.,;:}+-``~';
    for(let a=0;a<cadena.length;a++){
      for(let b=0;b<noValido.length;b++){
        if (cadena[a]==noValido[b]) {
          cont++;
        }
      }
    }

    let id=$(this).attr('id');
    $("span."+id).html('No ingrese caracteres especiales');
    if (cont>0 | cadena.length==0) {
      $(this).removeClass('is-valid'); //quitamos el css 'valido' para el campo y despues agregamos el invalido
      $(this).addClass('is-invalid');
      if (cont>0) {
        $("span."+id).html('No ingrese caracteres especiales');
        $('span.'+id).addClass('caracter');// no deja hacer submit al estar erroneos los datos
        $('span.'+id).removeClass('vacio');
      }else{
        $("span."+id).html('El campo no puede estar vacio');
        $('span.'+id).addClass('vacio');// no deja hacer submit al estar erroneos los datos
        $('span.'+id).removeClass('caracter');
      }
    }else{
      $('span.'+id).removeClass('caracter');
      $('span.'+id).removeClass('vacio');
      $('.form').attr('onsubmit','return true');
      $(this).removeClass('is-invalid');
      $(this).addClass('is-valid');
      $("span."+id).html('');
    }
    // $(".validar").bind("cut copy paste",function(e){
    //   e.prevetDefault();
    // });
  });
// FIN VALIDAR CAMPOS
// PAGINACION
  $(document).on("click",".page-link",function(){
    let url=$(this).attr('url-data');

    let n_pagina=$(this).attr('valor');
    let label=$(this).attr('aria-label');
    console.log(n_pagina)

    let total_paginas=$(this).attr('total_paginas');

    let aux=false;
    let vaNext=parseInt($('.Next').attr('valor'));
    let vaPrev=parseInt($('.Previous').attr('valor'));
    if (label=="Previous" && n_pagina != 1) {
      vaNext--;
      vaPrev--;
      $('.Next').attr('valor',vaNext);
      $('.Previous').attr('valor',vaPrev);
      n_pagina--
      $('#item_'+(n_pagina+1)).removeClass('active');
      aux=true;
    }else if (label=="Next" && n_pagina <= total_paginas){
      vaNext++;
      vaPrev++;
      $('.Next').attr('valor',vaNext);
      $('.Previous').attr('valor',vaPrev);
      $('#item_'+(n_pagina-1)).removeClass('active');
      aux=true;
    }
    if (aux) {
      $('#item_'+n_pagina).addClass('active');
      $.ajax({
        url:url,
        data:{
          valor:n_pagina,
        },
        type:"POST",
        success:function(datos){
          $("tbody").html(datos);
        }
      });

    }

  })
// FIN PAGINACION

// SIDEBAR
$(document).on("click","#miside",function(){
  let item=$(this).attr('id');
  console.log(item);
});
// FIN SIDEBAR


// $(document).on("click","#accionarModal",function(){
//   let accion=$(this).attr('accion');
//   let id=$(this).attr('com_id');
//   let nombre=$(this).attr('com_nombre');
//   let url=$(this).attr('url-data');
//
//   $('#titulo').html(accion+id);
//   $('#com_id').val(id);
//   $('#com_nombre').val(nombre);
//   $('.form').attr('action',url);
//   $('.form-control').prop('enabled');
//
//   if (accion=="Eliminar Comuna id ") {
//     $('.form-modal').attr('disabled','true');
//   }else{
//     $('.form-modal').removeAttr('disabled');
//   }
// });
// FIN EDITAR MODAL
  // $(document).on("click","#cambiar",function(){
  //    $("#cambiarImagen").html("<input type='file' name='ciu_imagen'>");
  // });


});
