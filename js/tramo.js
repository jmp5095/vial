$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  noPaste('tra_codigo');
  //TOASTR PERSONALIZADO
  let opc=myToastr();
  toastr.options=opc;


  // MODAl, ESTO MUESTRA EL MODAL
  $(document).on("click","#accionarModal",function(){
    let accion=$(this).attr('accion');
    let url=$(this).attr('data-url');

    if (accion=="eliminar") {
      $('#tra_codigo').attr('disabled','true');
      $('#id_barrio').attr('disabled','true');
      $('#id_tipo_pavimento').attr('disabled','true');
      $('#id_elemento_complementario').attr('disabled','true');
    }else{
      prepararCampo('tra_codigo');
      prepararCampo('id_barrio');
      prepararCampo('id_tipo_pavimento');
      prepararCampo('id_elemento_complementario');
    }

    if(accion=="registrar"){
      $('#titulo').html('Registrar Tramo');
      $('#tra_codigo').val('');
      $.ajax({
        type:"POST",
        url:url,
        success:function(resp){
          resp=JSON.parse(resp)
          // barrios
          let barrios=resp.barrios;
          let html=`<option value="">Seleccione...</option>`
          for (var i = 0; i < barrios.length; i++) {
            html+=`<option value="${barrios[i].bar_id}">${barrios[i].bar_nombre}</option>`
          }
          $('#id_barrio').html(html);
          // fin barrios
          // tipo_pavimento
          let pavimentos=resp.pavimentos;
          html=`<option value="">Seleccione...</option>`
          for (var i = 0; i < pavimentos.length; i++) {
            html+=`<option value="${pavimentos[i].tip_pav_id}">${pavimentos[i].tip_pav_nombre}</option>`
          }
          $('#id_tipo_pavimento').html(html);
          //fin tipo_pavimento
          //elemento_complementario
          let elementos=resp.elementos;
          html=`<option value="">Seleccione...</option>`
          for (var i = 0; i < elementos.length; i++) {
            html+=`<option value="${elementos[i].ele_com_id}">${elementos[i].ele_com_descripcion}</option>`
          }
          $('#id_elemento_complementario').html(html);
          //fin elemento_complementario
          // entornos
          let entornos=resp.entornos;
          html=``
          for (var i = 0; i < entornos.length; i++) {
            html+=`<tr>
              <td>${entornos[i].ent_nombre }</td>
              <td><input id='id_entorno_${entornos[i].ent_id}' type="checkbox" class="entorno" value="${entornos[i].ent_id}"></td>
            </tr>`
          }
          $('#tableEnt').html(html)
        }
      });//fin ajax


    }
    if(accion=="eliminar" | accion=="actualizar"){
      let id=$(this).attr('data-id');
      $('#tra_id').val(id)
        if (accion=="eliminar") {
          $('#titulo').html('Eliminar Tramo');
          disabled='disabled';
        }else{
          $('#titulo').html('Actualizar Tramo');
          disabled='';
        }

        $.ajax({
          type:"POST",
          url:url,
          data:{
            tra_id:id
          },
          success:function(resp){
            resp=JSON.parse(resp)
            let tramo=resp.tramo['tramo'][0];

            $('#tra_codigo').val(tramo.tra_codigo);
            // barrios
            let barrios=resp.barrios;
            let html=`<option value="">Seleccione...</option>`
            for (var i = 0; i < barrios.length; i++) {
              selected=(tramo.id_barrio==barrios[i].bar_id?'selected':'');

              html+=`<option value="${barrios[i].bar_id}" ${selected}>${barrios[i].bar_nombre}</option>`
            }
            $('#id_barrio').html(html);
            // fin barrios
            // tipo_pavimento
            let pavimentos=resp.pavimentos;
            html=`<option value="">Seleccione...</option>`
            for (var i = 0; i < pavimentos.length; i++) {
              selected=(tramo.id_tipo_pavimento==pavimentos[i].tip_pav_id?'selected':'');

              html+=`<option value="${pavimentos[i].tip_pav_id}" ${selected}>${pavimentos[i].tip_pav_nombre}</option>`
            }
            $('#id_tipo_pavimento').html(html);
            //fin tipo_pavimento
            //elemento_complementario
            let elementos=resp.elementos;
            html=`<option value="">Seleccione...</option>`
            for (var i = 0; i < elementos.length; i++) {
              selected=(tramo.id_elemento_complementario==elementos[i].ele_com_id?'selected':'');
              html+=`<option value="${elementos[i].ele_com_id}" ${selected}>${elementos[i].ele_com_descripcion}</option>`
            }
            $('#id_elemento_complementario').html(html);
            //fin elemento_complementario
            // entornos
            let entornos=resp.entornos;

            ent_tra=(resp.tramo['entornos']?resp.tramo['entornos']:null);
            html=``
            entornos.forEach((item, i) => {
              checked=''
              if (ent_tra) {
                for(let i=0;i<ent_tra.length;i++){
                  if(item.ent_id==ent_tra[i].id_entorno){
                    checked='checked'
                    ent_tra_id=item.ent_tra_id;
                    break;
                  }else{
                    checked=''
                    ent_tra_id=-1;
                  }
                }
              }
              html+=`<tr>
                <td>${item.ent_nombre }</td>
                <td><input id='${ent_tra_id}' type="checkbox" class="entorno" value="${item.ent_id}" ${checked} ${disabled}></td>
              </tr>`
            });

            $('#tableEnt').html(html)

          }
        });//fin ajax

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
    // variables del formulario
    let id=$('#tra_id').val();
    let codigo=$('#tra_codigo').val();
    let barrio=$('#id_barrio').val();
    let pavimento=$('#id_tipo_pavimento').val();
    let elemento=$('#id_elemento_complementario').val();
    let entornos=[];
    $(".entorno:checked").each(function(){entornos.push($(this).val());});

    if (accion=="registrar" | accion=="actualizar") {
      if (validarCampo('tra_codigo',codigo) && validarCampoSelect('id_barrio',barrio)) {
        if (validarCampoSelect('id_tipo_pavimento',pavimento) && validarCampoSelect('id_elemento_complementario',elemento)) {
          auxValido=true;
            datos={
              tra_id:id,
              tra_codigo:codigo,
              id_barrio:barrio,
              id_tipo_pavimento:pavimento,
              id_elemento_complementario:elemento,
              entornos:entornos
            }
        }
      }
    }

    if (accion=="eliminar") {
      auxValido=true;
      datos={
        tra_id:id
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
          url=getUrl("Tramo","Tramo","consultar",false,"ajax");
          $.ajax({
            type:"POST",
            url:url,
            success:function(resp){
              if (!resp['errorMsg']) {
                  json=JSON.parse(resp)
                  tramos=json['tramos'];
                  let html=``;
                  tramos.forEach((item, i) => {
                    html+=`
                    <tr >
                      <td class="text-center">${item.tra_id}</td>
                      <td class="text-center">${item.tra_codigo}</td>
                      <td class="text-center">${item.bar_nombre}</td>
                      <td class="text-center">${item.tip_pav_nombre}</td>
                      <td class="text-center">
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                        accion="actualizar"
                        data-id="${item.tra_id}"
                        data-url="${getUrl("Tramo","Tramo","getUpdate",false,"ajax")}"
                        data-url-post="${getUrl("Tramo","Tramo","postUpdate",false,"ajax")}">
                          Editar
                        </a>
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                        accion="eliminar"
                        data-id="${item.tra_id}"
                        data-url="${getUrl("Tramo","Tramo","getDelete",false,"ajax")}"
                        data-url-post="${getUrl("Tramo","Tramo","postDelete",false,"ajax")}">
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
  // PAGINACION
  let table = crearTabla();

  $(document).on('click','#myTableBtn', (arguments) => {

  })
  //FIN PAGINACION


});
