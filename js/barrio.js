$(document).ready(function(){
  // EVITAR PEGAR TEXTO
  noPaste('bar_nombre');
  //TOASTR PERSONALIZADO
  let opc=myToastr();
  toastr.options=opc;


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
      $('#id_comuna').html('<option>'+comuna+'</>');

      prepararCampo('bar_nombre');
      prepararCampoSelect('id_comuna');
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
          url=getUrl("Barrio","Barrio","consultar",false,"ajax");
          $.ajax({
            type:"POST",
            url:url,
            success:function(resp){
              if (!resp['errorMsg']) {
                  json=JSON.parse(resp)
                  barrios=json['barrios']
                  let html=``;
                  barrios.forEach((item, i) => {
                    html+=`
                    <tr >
                      <td class="text-center">${item.bar_id}</td>
                      <td class="text-center">${item.bar_nombre}</td>
                      <td class="text-center">${item.com_nombre}</td>
                      <td class="text-center">
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
                        accion="actualizar"
                        data-id="${item.bar_id}"
                        data-nombre="${item.bar_nombre}"
                        data-id-comuna="${item.com_id}"
                        data-url="${getUrl("Barrio","Barrio","getCreate",false,"ajax")}"
                        data-url-post="${getUrl("Barrio","Barrio","postUpdate",false,"ajax")}">
                          Editar
                        </a>
                        <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
                        accion="eliminar"
                        data-id="${item.bar_id}"
                        data-nombre="${item.bar_nombre}"
                        data-comuna="${item.com_nombre}"
                        data-url-post="${getUrl("Barrio","Barrio","postDelete",false,"ajax")}">
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
