<?php
include_once '../model/TipoPavimento/TipoPavimentoModel.php';
include_once '../model/MasterModel.php';
class TipoPavimentoController{

  function getCreate(){
    include_once '../views/TipoPavimento/create.php';
  }
  function postCreate(){
    $tip_pav_nombre=$_POST['tip_pav_nombre'];


    $objeto=new TipoPavimentoModel();
    $tip_pav_id=$objeto->autoincrement("tipo_pavimento","tip_pav_id");
    $sql="INSERT INTO tipo_pavimento (tip_pav_id,tip_pav_nombre)VALUES ($tip_pav_id,'$tip_pav_nombre')";
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
    $tip_pav_id=$_GET['tip_pav_id'];
    $tip_pav_nombre=$_GET['tip_pav_nombre'];

    include_once '../views/TipoPavimento/update.php';
  }
  function postUpdate(){
      $tip_pav_id=$_POST['tip_pav_id'];
      $tip_pav_nombre=$_POST['tip_pav_nombre'];


      $objeto=new TipoPavimentoModel();
      $sql="UPDATE tipo_pavimento SET tip_pav_nombre='$tip_pav_nombre' WHERE tip_pav_id=$tip_pav_id";
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
    $tip_pav_id=$_GET['tip_pav_id'];
    $tip_pav_nombre=$_GET['tip_pav_nombre'];
    include_once '../views/TipoPavimento/delete.php';
  }
  function postDelete(){
    $tip_pav_id=$_POST['tip_pav_id'];
    $sql="DELETE FROM tipo_pavimento WHERE tip_pav_id=$tip_pav_id";

    $objeto=new TipoPavimentoModel();
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
    $objeto= new TipoPavimentoModel();
    $sql= "SELECT * FROM tipo_pavimento ORDER BY tip_pav_id ";
    $tipos=$objeto->consult($sql);

    include_once '../views/TipoPavimento/index.php';
  }
  function consultar(){
    $objeto= new TipoPavimentoModel();
    $sql= "SELECT * FROM tipo_pavimento ORDER BY tip_pav_id ";
    $pavimentos=$objeto->consult($sql);

    $arrPavimentos=array();
    while ($row=pg_fetch_assoc($pavimentos)) {
    array_push($arrPavimentos,$row);
    }
    $arrResp=array();
    if ($pavimentos) {
      $arrResp['tipoPavimentos']=$arrPavimentos;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

}

 ?>
