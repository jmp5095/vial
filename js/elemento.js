$(document).ready(function(){
    // EVITAR PEGAR TEXTO
    noPaste('ele_com_descripcion');

    //TOASTR PERSONALIZADO
    let opc=myToastr();
    toastr.options=opc;

    // MODAl, ESTO MUESTRA EL MODAL
    $(document).on("click","#accionarModal",function(){
      let accion=$(this).attr('accion');
      let url=$(this).attr('data-url');

      if(accion=="registrar"){
        $('#titulo').html('Registrar entorno');
        $('#ele_com_descripcion').val('');



        prepararCampo('ele_com_descripcion');

      }
      if(accion=="actualizar"){
        let id=$(this).attr('data-id');
        let descripcion=$(this).attr('data-descripcion');

        $('#titulo').html('Actualizar elemento id '+id);
        $('#ele_com_id').val(id);
        $('#ele_com_descripcion').val(descripcion);


        prepararCampo('ele_com_descripcion');

      }
      if(accion=="eliminar"){
        let id=$(this).attr('data-id');
        let descripcion=$(this).attr('data-descripcion');


        $('#titulo').html('Eliminar elemento id '+id);
        $('#ele_com_id').val(id);
        $('#ele_com_descripcion').val(descripcion);


        prepararCampo('ele_com_descripcion');

        $('#ele_com_descripcion').attr('disabled','true');

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
        let  descripcion=$('#ele_com_descripcion').val().trim();


        if (validarCampo('ele_com_descripcion',descripcion) ) {
          auxValido=true;
          datos={
            ele_com_descripcion:descripcion,

          }
        }
      }
      if (accion=="actualizar") {
        //validamos que no este vacio
        let  id=$('#ele_com_id').val();
        let  descripcion=$('#ele_com_descripcion').val().trim();

        if (validarCampo('ele_com_descripcion',descripcion) ) {
          auxValido=true;
          datos={
            ele_com_id:id,
            ele_com_descripcion:descripcion,

          }
        }
      }
      if (accion=="eliminar") {
        auxValido=true;
        let id=$('#ele_com_id').val();
        datos={
          ele_com_id:id
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
            url=getUrl("Elemento","Elemento","consultar",false,"ajax");
            $.ajax({
              type:"POST",
              url:url,
              success:function(resp){
                if (!resp['errorMsg']) {
                    json=JSON.parse(resp)
                    elementos=json['elementos']
                    let html=``;
                    elementos.forEach((item, i) => {
                      html+=`
                      <tr >
                        <td class="text-center">${item.ele_com_id}</td>
                        <td class="text-center">${item.ele_com_descripcion}</td>

                        <td class="text-center">
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                          accion="actualizar"
                          data-id="${item.ele_com_id}"
                          data-descripcion="${item.ele_com_descripcion}"

                          data-url-post="${getUrl("Elemento","Elemento","postUpdate",false,"ajax")}">
                            Editar
                          </a>
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                          accion="eliminar"
                          data-id="${item.ele_com_id}"
                          data-descripcion="${item.ele_com_descripcion}"

                          data-url-post="${getUrl("Elemento","Elemento","postDelete",false,"ajax")}">
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
