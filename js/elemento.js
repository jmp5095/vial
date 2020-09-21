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
          }
  
        });
      }
  
  
    });
    //FIN BOTON DEL MODAL
  
    // PAGINACION
    let idioma=idiomaDataTable();
    let table = $('#myTable').DataTable({
      "language":idioma
    });
  
    $(document).on('click','#myTableBtn', (arguments) => {
  
    })
    //FIN PAGINACION
  
  
  });