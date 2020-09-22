<?php
include_once '../model/Comuna/ComunaModel.php';
include_once '../model/MasterModel.php';
class ComunaController{

  function getCreate(){
    include_once '../views/Comuna/create.php';
  }
  function postCreate(){
      $com_nombre=$_POST['com_nombre'];
      $objeto=new ComunaModel();
      $com_id=$objeto->autoincrement("comuna","com_id");
      $sql="INSERT INTO comuna (com_id,com_nombre)VALUES ($com_id,'$com_nombre')";
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
    $com_id=$_GET['com_id'];
    $com_nombre=$_GET['com_nombre'];
    include_once '../views/Comuna/update.php';
  }
  function postUpdate(){

      $com_id=$_POST['com_id'];
      $com_nombre=$_POST['com_nombre'];
      $objeto=new ComunaModel();

      $sql="UPDATE comuna SET com_nombre='$com_nombre' WHERE com_id=$com_id";
      $resp=$objeto->update($sql);

      $arrResp=array();
      if ($resp) {
        $arrResp['successMsg']="Registro exitoso";
      }else{
        $arrResp['errorMsg']="Ocurrio un error!";
      }
      echo json_encode($arrResp);
  }

  function getDelete(){
    $com_id=$_GET['com_id'];
    $com_nombre=$_GET['com_nombre'];
    include_once '../views/Comuna/delete.php';
  }
  function postDelete(){
    $com_id=$_POST['com_id'];
    $sql="DELETE FROM comuna WHERE com_id=$com_id";

    $objeto=new ComunaModel();
    $resp=$objeto->delete($sql);

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Registro exitoso";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }
  function index(){
    $objeto= new ComunaModel();

    $sql= "SELECT * FROM comuna ORDER BY com_id";
    $comunas=$objeto->consult($sql);

    include_once '../views/Comuna/index.php';
  }

  function consultar(){
    $objeto=new ComunaModel();
    $sql="SELECT * FROM comuna ORDER BY com_id";
    $comunas=$objeto->consult($sql);

    $arrComunas=array();
    while ($row=pg_fetch_assoc($comunas)) {
    array_push($arrComunas,$row);
    }
    $arrResp=array();
    if ($comunas) {
      $arrResp['comunas']=$arrComunas;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }
}

 ?>
