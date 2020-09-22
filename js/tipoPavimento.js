$(document).ready(function(){
    // EVITAR PEGAR TEXTO
    noPaste('tip_pav_nombre');

    //TOASTR PERSONALIZADO
    let opc=myToastr();
    toastr.options=opc;

    // MODAl, ESTO MUESTRA EL MODAL
    $(document).on("click","#accionarModal",function(){
      let accion=$(this).attr('accion');
      let url=$(this).attr('data-url');

      if(accion=="registrar"){
        $('#titulo').html('Registrar pavimento');
        $('#tip_pav_nombre').val('');

        prepararCampo('tip_pav_nombre');

      }
      if(accion=="actualizar"){
        let id=$(this).attr('data-id');
        let nombre=$(this).attr('data-nombre');

        $('#titulo').html('Actualizar pavimento id '+id);
        $('#tip_pav_id').val(id);
        $('#tip_pav_nombre').val(nombre);


        prepararCampo('tip_pav_nombre');

      }
      if(accion=="eliminar"){
        let id=$(this).attr('data-id');
        let nombre=$(this).attr('data-nombre');


        $('#titulo').html('Eliminar pavimento id '+id);
        $('#tip_pav_id').val(id);
        $('#tip_pav_nombre').val(nombre);


        prepararCampo('tip_pav_nombre');

        $('#tip_pav_nombre').attr('disabled','true');

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
        let  nombre=$('#tip_pav_nombre').val().trim();


        if (validarCampo('tip_pav_nombre',nombre) ) {
          auxValido=true;
          datos={
            tip_pav_nombre:nombre,

          }
        }
      }
      if (accion=="actualizar") {
        //validamos que no este vacio
        let  id=$('#tip_pav_id').val();
        let  nombre=$('#tip_pav_nombre').val().trim();

        if (validarCampo('tip_pav_nombre',nombre) ) {
          auxValido=true;
          datos={
            tip_pav_id:id,
            tip_pav_nombre:nombre,

          }
        }
      }
      if (accion=="eliminar") {
        auxValido=true;
        let id=$('#tip_pav_id').val();
        datos={
          tip_pav_id:id
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
            url=getUrl("TipoPavimento","TipoPavimento","consultar",false,"ajax");
            $.ajax({
              type:"POST",
              url:url,
              success:function(resp){
                if (!resp['errorMsg']) {
                    console.log(resp)
                    json=JSON.parse(resp)
                    tipoPavimento=json['tipoPavimentos']
                    let html=``;
                    tipoPavimento.forEach((item, i) => {
                      html+=`
                      <tr >
                        <td class="text-center">${item.tip_pav_id}</td>
                        <td class="text-center">${item.tip_pav_nombre}</td>

                        <td class="text-center">
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                          accion="actualizar"
                          data-id="${item.tip_pav_id}"
                          data-nombre="${item.tip_pav_nombre}"

                          data-url-post="${getUrl("TipoPavimento","TipoPavimento","postUpdate",false,"ajax")}">
                            Editar
                          </a>
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                          accion="eliminar"
                          data-id="${item.tip_pav_id}"
                          data-nombre="${item.tip_pav_nombre}"

                          data-url-post="${getUrl("TipoPavimento","TipoPavimento","postDelete",false,"ajax")}">
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
