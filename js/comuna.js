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
    url=$(this).attr('data-url-post');
    $('#btnModal').attr('accion',accion);
    $('#btnModal').attr('data-url-post',url);
  });
  // FIN MODAL ESTO MUESTRA EL MODAL
  // BOTON DEL MODAL
  $(document).on("click","#btnModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url-post');
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
          let typeMsg;
          let msg=JSON.parse(resp);
          console.log(msg)
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

          toastr[typeMsg](msg,titleMsg);
          $('#modal').modal('hide');
          url=getUrl("Comuna","Comuna","consultar",false,"ajax");
          $.ajax({
            type:"POST",
            url:url,
            success:function(resp){
              if (!resp['errorMsg']) {
                  json=JSON.parse(resp)
                  comunas=json['comunas']
                  console.log(comunas)
                  let html=``;
                  comunas.forEach((item, i) => {
                    html+=`
                    <tr >
                      <td class="text-center">${item.com_id}</td>
                      <td class="text-center">${item.com_nombre}</td>

                      <td class="text-center">
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                        accion="actualizar"
                        data-id="${item.com_id}"
                        data-nombre="${item.com_nombre}"

                        data-url-post="${getUrl("Comuna","Comuna","postUpdate",false,"ajax")}">
                          Editar
                        </a>
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                        accion="eliminar"
                        data-id="${item.com_id}"
                        data-nombre="${item.com_nombre}"

                        data-url-post="${getUrl("Comuna","Comuna","postDelete",false,"ajax")}">
                          Erradicar
                        </a>
                      </td>
                    </tr>
                    `;
                  });
                  table.destroy();
                  $('#myTable > tbody').html(html);
                  table = crearTabla();
              }
            }
          });//fin ajax
        }

      });




    }


  });
  //FIN BOTON DEL MODAL

  // PAGINACION
  let table = crearTabla();

  $(document).on('click','#myTableBtn', (arguments) => {

  })
  //FIN PAGINACION


});
