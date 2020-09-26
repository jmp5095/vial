<?php
include_once '../model/Tramo/TramoModel.php';
include_once '../model/MasterModel.php';

class TramoController{
  function getCreate($tra=false){
    $objeto=new TramoModel();

    $sql="SELECT * FROM barrio ORDER BY bar_id";
    $barrios=$objeto->consult($sql);

    $arrResp=array();
    while($row=pg_fetch_assoc($barrios)){
      $arrResp['barrios'][]=$row;
    }

    $sql="SELECT * FROM tipo_pavimento ORDER BY tip_pav_id";
    $tipo_pavimento=$objeto->consult($sql);

    while ($row=pg_fetch_assoc($tipo_pavimento)) {
      $arrResp['pavimentos'][]=$row;
    }

    $sql="SELECT * FROM elemento_complementario ORDER BY ele_com_id";
    $elementos=$objeto->consult($sql);

    while ($row=pg_fetch_assoc($elementos)) {
      $arrResp['elementos'][]=$row;
    }

    $sql="SELECT * FROM entorno ORDER BY ent_id";
    $entornos=$objeto->consult($sql);

    while ($row=pg_fetch_assoc($entornos)) {
      $arrResp['entornos'][]=$row;
    }
    if ($tra) {
      $arrResp['tramo']=$tra;
    }
    echo json_encode($arrResp);

  }
  function postCreate(){

      $tra_codigo=$_POST['tra_codigo'];
      $id_barrio=$_POST['id_barrio'];
      $id_tipo_pavimento=$_POST['id_tipo_pavimento'];
      $id_elemento_complementario=$_POST['id_elemento_complementario'];


      $objeto=new TramoModel();

      $tra_id=$objeto->autoincrement("tramo","tra_id");
      $arrResp=array();

      $sql="INSERT INTO tramo VALUES($tra_id,'$tra_codigo',$id_barrio,$id_tipo_pavimento,$id_elemento_complementario)";
      $resp=$objeto->insert($sql);

      if (isset($_POST['entornos'])) {
        $entornos=$_POST['entornos'];
        foreach ($entornos as $id_entorno) {
          $objeto->insert("INSERT INTO entorno_tramo VALUES(DEFAULT,$id_entorno,$tra_id)");
        }
      }

      if ($resp) {
        $arrResp['successMsg']="Registro exitoso";
      }else{
        $arrResp['errorMsg']="Ocurrio un error!";
      }

      echo json_encode($arrResp);
  }
  public function getUpdate(){
    $id=$_POST['tra_id'];
    $objeto=new TramoModel();
    $tramo=$objeto->consult("SELECT tra_id,tra_codigo,id_barrio,id_tipo_pavimento,id_elemento_complementario
                            FROM tramo WHERE tra_id=$id");
    $entornos=$objeto->consult("SELECT * FROM entorno_tramo WHERE id_tramo=$id");

    $arr=array();
    while ($row=pg_fetch_assoc($tramo)) {
      $arr['tramo'][]=$row;
    }
    while ($row=pg_fetch_assoc($entornos)) {
      $arr['entornos'][]=$row;
    }

    $this->getCreate($arr);

  }

  public function postUpdate(){
    $tra_id=$_POST['tra_id'];
    $tra_codigo=$_POST['tra_codigo'];
    $id_barrio=$_POST['id_barrio'];
    $id_tipo_pavimento=$_POST['id_tipo_pavimento'];
    $id_elemento_complementario=$_POST['id_elemento_complementario'];

    $objeto=new TramoModel();

    $arrResp=array();

    $sql="UPDATE tramo SET tra_codigo='$tra_codigo',id_barrio=$id_barrio,id_tipo_pavimento=$id_tipo_pavimento,id_elemento_complementario=$id_elemento_complementario WHERE tra_id=$tra_id";
    $resp=$objeto->update($sql);

    $objeto->delete("DELETE FROM entorno_tramo WHERE id_tramo=$tra_id");

    if (isset($_POST['entornos'])) {
      $entornos=$_POST['entornos'];
      foreach ($entornos as $id_entorno) {
        $objeto->insert("INSERT INTO entorno_tramo VALUES(DEFAULT,$id_entorno,$tra_id)");
      }
    }


    if ($resp) {
      $arrResp['successMsg']="Registro exitoso";
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }

    echo json_encode($arrResp);
  }
  public function getDelete(){
    $id=$_POST['tra_id'];
    $objeto=new TramoModel();
    $tramo=$objeto->consult("SELECT tra_id,tra_codigo,id_barrio,id_tipo_pavimento,id_elemento_complementario
                            FROM tramo WHERE tra_id=$id");
    $entornos=$objeto->consult("SELECT * FROM entorno_tramo WHERE id_tramo=$id");

    $arr=array();
    while ($row=pg_fetch_assoc($tramo)) {
      $arr['tramo'][]=$row;
    }
    while ($row=pg_fetch_assoc($entornos)) {
      $arr['entornos'][]=$row;
    }

    $this->getCreate($arr);
  }

  function postDelete(){
    $id=$_POST['tra_id'];
    $objeto=new TramoModel();
    $objeto->delete("DELETE FROM entorno_tramo WHERE id_tramo=$id");
    $resp=$objeto->delete("DELETE FROM tramo WHERE tra_id=$id");

    $arrResp=array();
    if ($resp) {
      $arrResp['successMsg']="Eliminación exitosa";
    }else{
      $arrResp['errorMsg']="Ocurrio un error";
    }
    echo json_encode($arrResp);
  }

  function index(){
    $objeto= new TramoModel();
    $sql="SELECT t.tra_id,t.tra_codigo,b.bar_nombre,tp.tip_pav_nombre
                FROM tramo as t,barrio as b,tipo_pavimento as tp
                WHERE t.id_barrio=b.bar_id
                AND t.id_tipo_pavimento=tp.tip_pav_id
                ORDER BY t.tra_id";
    $tramos=$objeto->consult($sql);

    include_once '../views/Tramo/index.php';
  }
  function consultar(){
    $objeto= new TramoModel();
    $sql="SELECT t.tra_id,t.tra_codigo,b.bar_nombre,tp.tip_pav_nombre
          FROM tramo as t,barrio as b,tipo_pavimento as tp
          WHERE t.id_barrio=b.bar_id
          AND t.id_tipo_pavimento=tp.tip_pav_id
          ORDER BY t.tra_id";
    $tramos=$objeto->consult($sql);

    $arrTramos=array();
    while ($row=pg_fetch_assoc($tramos)) {
    array_push($arrTramos,$row);
    }
    $arrResp=array();
    if ($tramos) {
      $arrResp['tramos']=$arrTramos;
    }else{
      $arrResp['errorMsg']="Ocurrio un error!";
    }
    echo json_encode($arrResp);
  }

}


?>
