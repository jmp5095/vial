<?php
include_once '../model/Elemento/ElementoModel.php';
include_once '../model/MasterModel.php';
class ElementoController{

  function getCreate(){

  }
  function postCreate(){
    $ele_com_descripcion=$_POST['ele_com_descripcion'];


    $objeto=new ElementoModel();
    $ele_com_id=$objeto->autoincrement("elemento_complementario","ele_com_id");
    $sql="INSERT INTO elemento_complementario (ele_com_id,ele_com_descripcion)VALUES ($ele_com_id,'$ele_com_descripcion')";
    $resp=$objeto->insert($sql);

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Registro exitoso";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }

    echo json_encode($arrResp);
  }
  function getUpdate(){
    $ele_com_id=$_GET['ele_com_id'];
    $ele_com_descripcion=$_GET['ele_com_descripcion'];


  }
  function postUpdate(){
      $ele_com_id=$_POST['ele_com_id'];
      $ele_com_descripcion=$_POST['ele_com_descripcion'];


      $objeto=new ElementoModel();
      $sql="UPDATE elemento_complementario SET ele_com_descripcion='$ele_com_descripcion' WHERE ele_com_id=$ele_com_id";
      $resp=$objeto->update($sql);
      $arrResp=array();
      if ($resp) {
        $arrResp['successMsg']="Actualización exitosa";
      }else{
        $arrResp['errorMsg']="Ocurrio un error!";
      }
      echo json_encode($arrResp);
  }

  function getDelete(){
    $ele_com_id=$_GET['ele_com_id'];
    $ele_com_descripcion=$_GET['ele_com_descripcion'];

  }
  function postDelete(){
    $ele_com_id=$_POST['ele_com_id'];
    $sql="DELETE FROM elemento_complementario WHERE ele_com_id=$ele_com_id";

    $objeto=new ElementoModel();
    $resp=$objeto->delete($sql);

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Eliminación exitosa";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }
  function index(){
    $objeto= new ElementoModel();
    $sql= "SELECT * FROM elemento_complementario ORDER BY ele_com_id ";
    $elementos=$objeto->consult($sql);

    include_once '../views/Elemento/index.php';
  }

}

 ?>
