<?php
include_once '../model/Barrio/BarrioModel.php';
include_once '../model/MasterModel.php';

class BarrioController{
  function getCreate(){
    $objeto=new BarrioModel();

    $sql="SELECT * FROM comuna ORDER BY com_id";
    $comunas=$objeto->consult($sql);

    $arrResp=array();
    while($row=pg_fetch_assoc($comunas)){
      $arrResp[]=$row;
    }
    echo json_encode($arrResp);

  }
  function postCreate(){
    if ($_POST['bar_nombre']=="" or $_POST['id_comuna']=="") {
      if ($_POST['bar_nombre']=="") {
        $_SESSION['error']['nombre']="Ingrese un nombre por favor.";
      }
      if ($_POST['id_comuna']=="") {
        $_SESSION['error']['comuna']="Ingrese una comuna por favor.";
      }
      // redirect(getUrl("Barrio","Barrio","getCreate"));
    }else{
      $bar_nombre=$_POST['bar_nombre'];
      $com_id=$_POST['id_comuna'];
      $objeto=new BarrioModel();

      $bar_id=$objeto->autoincrement("barrio","bar_id");

      $sql="INSERT INTO barrio VALUES($bar_id,'$bar_nombre',$com_id)";
      $resp=$objeto->insert($sql);

      $arrResp=array();
      if ($resp) {
        $arrResp['successMsg']="Registro exitoso";
      }else{
        $arrResp['errorMsg']="Ocurrio un error!";
      }
      echo json_encode($arrResp);

    }
  }
  public function getUpdate(){

    $objeto=new BarrioModel();

    $bar_id=$_GET['bar_id'];
    $bar_nombre=$_GET['bar_nombre'];
    $com_id=$_GET['com_id'];

    $sql2="SELECT * FROM comuna ORDER BY com_id";

    $comuna=$objeto->consult($sql2);

    include_once '../views/Barrio/update.php';
  }

  public function postUpdate(){

    $objeto=new BarrioModel();

    $bar_id=$_POST['bar_id'];
    $bar_nombre=$_POST['bar_nombre'];
    $com_id=$_POST['id_comuna'];


    $sql="UPDATE barrio SET bar_nombre='$bar_nombre', id_comuna=$com_id WHERE bar_id=$bar_id";

    $resp=$objeto->update($sql);

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Actualizacion exitosa!";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);

  }
  public function getDelete(){
    $bar_id=$_GET['bar_id'];
    $bar_nombre=$_GET['bar_nombre'];
    $objeto=new BarrioModel();

    $sql="SELECT  b.bar_nombre, c.com_nombre, c.com_id, b.id_comuna FROM barrio b, comuna c WHERE bar_id=$bar_id and c.com_id=b.id_comuna";

    $barrios=$objeto->consult($sql);

    include_once '../views/Barrio/delete.php';
  }

  function postDelete(){
    $bar_id=$_POST['bar_id'];
    $sql="DELETE FROM barrio WHERE bar_id=$bar_id";

    $objeto=new BarrioModel();
    $resp=$objeto->delete($sql);

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Eliminación exitosa!";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

  function index(){

    $objeto= new BarrioModel();
    $sql="SELECT b.bar_id, b.bar_nombre, c.com_id, c.com_nombre FROM barrio b,comuna c WHERE b.id_comuna=c.com_id ORDER BY bar_id";
    $barrios=$objeto->consult($sql);



    include_once '../views/Barrio/index.php';
  }
  function consultar(){
    $objeto= new BarrioModel();
    $sql="SELECT b.bar_id, b.bar_nombre, c.com_id, c.com_nombre FROM barrio b,comuna c WHERE b.id_comuna=c.com_id ORDER BY bar_id";
    $barrios=$objeto->consult($sql);

    $arrBarrios=array();
    while ($row=pg_fetch_assoc($barrios)) {
    array_push($arrBarrios,$row);
    }
    $arrResp=array();
    if ($barrios) {
      $arrResp['barrios']=$arrBarrios;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

}


?>
