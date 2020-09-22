$(document).ready(function(){
    // EVITAR PEGAR TEXTO
    noPaste('ent_nombre');

    //TOASTR PERSONALIZADO
    let opc=myToastr();
    toastr.options=opc;

    // MODAl, ESTO MUESTRA EL MODAL
    $(document).on("click","#accionarModal",function(){
      let accion=$(this).attr('accion');
      let url=$(this).attr('data-url');

      if(accion=="registrar"){
        $('#titulo').html('Registrar entorno');
        $('#ent_nombre').val('');



        prepararCampo('ent_nombre');

      }
      if(accion=="actualizar"){
        let id=$(this).attr('data-id');
        let nombre=$(this).attr('data-nombre');

        $('#titulo').html('Actualizar entorno id '+id);
        $('#ent_id').val(id);
        $('#ent_nombre').val(nombre);


        prepararCampo('ent_nombre');

      }
      if(accion=="eliminar"){
        let id=$(this).attr('data-id');
        let nombre=$(this).attr('data-nombre');


        $('#titulo').html('Eliminar entorno id '+id);
        $('#ent_id').val(id);
        $('#ent_nombre').val(nombre);


        prepararCampo('ent_nombre');

        $('#ent_nombre').attr('disabled','true');

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
        let  nombre=$('#ent_nombre').val().trim();


        if (validarCampo('ent_nombre',nombre) ) {
          auxValido=true;
          datos={
            ent_nombre:nombre,

          }
        }
      }
      if (accion=="actualizar") {
        //validamos que no este vacio
        let  id=$('#ent_id').val();
        let  nombre=$('#ent_nombre').val().trim();

        if (validarCampo('ent_nombre',nombre) ) {
          auxValido=true;
          datos={
            ent_id:id,
            ent_nombre:nombre,

          }
        }
      }
      if (accion=="eliminar") {
        auxValido=true;
        let id=$('#ent_id').val();
        datos={
          ent_id:id
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

            toastr[typeMsg](msg,titleMsg);
            $('#modal').modal('hide');

            url=getUrl("Entorno","Entorno","consultar",false,"ajax");
            $.ajax({
              type:"POST",
              url:url,
              success:function(resp){
                if (!resp['errorMsg']) {
                    json=JSON.parse(resp)
                    entornos=json['entornos']
                    let html=``;
                    entornos.forEach((item, i) => {
                      html+=`
                      <tr >
                        <td class="text-center">${item.ent_id}</td>
                        <td class="text-center">${item.ent_nombre}</td>

                        <td class="text-center">
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                          accion="actualizar"
                          data-id="${item.ent_id}"
                          data-nombre="${item.ent_nombre}"

                          data-url="${getUrl("Entorno","Entorno","postUpdate",false,"ajax")}">
                            Editar
                          </a>
                          <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                          accion="eliminar"
                          data-id="${item.ent_id}"
                          data-nombre="${item.ent_nombre}"

                          data-url="${getUrl("Entorno","Entorno","postDelete",false,"ajax")}">
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
