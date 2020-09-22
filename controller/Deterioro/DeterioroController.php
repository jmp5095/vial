<?php
include_once '../model/Deterioro/DeterioroModel.php';
include_once '../model/MasterModel.php';
class DeterioroController{

  function getCreate(){
    include_once '../views/Deterioro/create.php';
  }
  function postCreate(){
    $det_nombre=$_POST['det_nombre'];
    $det_descripcion=$_POST['det_descripcion'];

    $objeto=new DeterioroModel();
    $det_id=$objeto->autoincrement("deterioro","det_id");
    $sql="INSERT INTO deterioro (det_id,det_nombre,det_descripcion)VALUES ($det_id,'$det_nombre','$det_descripcion')";
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
    $det_id=$_GET['det_id'];
    $det_nombre=$_GET['det_nombre'];
    $det_descripcion=$_GET['det_descripcion'];
    include_once '../views/Deterioro/update.php';
  }
  function postUpdate(){
      $det_id=$_POST['det_id'];
      $det_nombre=$_POST['det_nombre'];
      $det_descripcion=$_POST['det_descripcion'];

      $objeto=new DeterioroModel();
      $sql="UPDATE deterioro SET det_nombre='$det_nombre',det_descripcion='$det_descripcion' WHERE det_id=$det_id";
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
    $det_id=$_GET['det_id'];
    $det_nombre=$_GET['det_nombre'];
    include_once '../views/Deterioro/delete.php';
  }
  function postDelete(){
    $det_id=$_POST['det_id'];
    $sql="DELETE FROM deterioro WHERE det_id=$det_id";

    $objeto=new DeterioroModel();
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
    $objeto= new DeterioroModel();
    $sql= "SELECT * FROM deterioro ORDER BY det_id ";
    $deterioros=$objeto->consult($sql);

    include_once '../views/Deterioro/index.php';
  }
  function consultar(){
    $objeto=new DeterioroModel();
    $sql="SELECT * FROM deterioro ORDER BY det_id";
    $deterioros=$objeto->consult($sql);

    $arrDeterioros=array();
    while ($row=pg_fetch_assoc($deterioros)) {
    array_push($arrDeterioros,$row);
    }
    $arrResp=array();
    if ($deterioros) {
      $arrResp['deterioros']=$arrDeterioros;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

}

 ?>
