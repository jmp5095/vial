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
  