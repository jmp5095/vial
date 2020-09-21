<?php
include_once '../model/Entorno/EntornoModel.php';
include_once '../model/MasterModel.php';
class EntornoController{

  function getCreate(){

  }
  function postCreate(){
    $ent_nombre=$_POST['ent_nombre'];


    $objeto=new EntornoModel();
    $ent_id=$objeto->autoincrement("entorno","ent_id");
    $sql="INSERT INTO entorno (ent_id,ent_nombre)VALUES ($ent_id,'$ent_nombre')";
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
    $ent_id=$_GET['ent_id'];
    $ent_nombre=$_GET['ent_nombre'];

    include_once '../views/Entorno/update.php';
  }
  function postUpdate(){
      $ent_id=$_POST['ent_id'];
      $ent_nombre=$_POST['ent_nombre'];


      $objeto=new EntornoModel();
      $sql="UPDATE entorno SET ent_nombre='$ent_nombre' WHERE ent_id=$ent_id";
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
    $ent_id=$_GET['ent_id'];
    $ent_nombre=$_GET['ent_nombre'];
    include_once '../views/Deterioro/delete.php';
  }
  function postDelete(){
    $ent_id=$_POST['ent_id'];
    $sql="DELETE FROM entorno WHERE ent_id=$ent_id";

    $objeto=new EntornoModel();
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
    $objeto= new EntornoModel();
    $sql= "SELECT * FROM entorno ORDER BY ent_id ";
    $entornos=$objeto->consult($sql);

    include_once '../views/Entorno/index.php';
  }
  function consultar(){
    $objeto=new EntornoModel();
    $sql="SELECT * FROM entorno ORDER BY ent_id";
    $entornos=$objeto->consult($sql);

    $arrEntornos=array();
    while ($row=pg_fetch_assoc($entornos)) {
    array_push($arrEntornos,$row);
    }
    $arrResp=array();
    if ($entornos) {
      $arrResp['entornos']=$arrEntornos;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

}

 ?>
