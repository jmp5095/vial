<?php

include_once '../model/TipoPavimento/TipoPavimentoModel.php';
include_once '../model/MasterModel.php';
class TipoPavimentoController {
  function getCreate(){
    include_once '../views/TipoPavimento/create.php';
  }
  function postCreate(){
    if ($_POST['tip_pav_nombre']=="") {
      $_SESSION['error']['nombre']="Ingrese el nombre de tipo Pavimento";
      redirect(getUrl("TipoPavimento","TipoPavimento","getCreate"));
    }else{
      $tip_nombre=$_POST['tip_pav_nombre'];

      $objeto=new TipoPavimentoModel();
      $tip_id=$objeto->autoincrement("tipo_pavimento","tip_pav_id");
      $sql="INSERT INTO tipo_pavimento (tip_pav_id,tip_pav_nombre)VALUES ($tip_id,'$tip_nombre')";
      $resp=$objeto->insert($sql);

      if ($resp) {
        successMsg();
        redirect(getUrl("TipoPavimento","TipoPavimento","index"));
      }else{
        errorMsg();
      }
    }

  }
  function getUpdate(){
    $tip_id=$_GET['tip_pav_id'];
    $tip_nombre=$_GET['tip_pav_nombre'];
    include_once '../views/TipoPavimento/update.php';
  }
  function postUpdate(){
    if ($_POST['tip_pav_nombre']=="") {
      $_SESSION['error']['nombre']="Ingrese un nombre porfavor";
      $tipo=array(
        'tip_pav_id' => $_POST['tip_pav_id'],
        'tip_pav_nombre' => $_POST['tip_nombre_actual']
      );
      redirect(getUrl("TipoPavimento","TipoPavimento","getUpdate",$tipo));
    }else{
      $tip_id=$_POST['tip_pav_id'];
      $tip_nombre=$_POST['tip_pav_nombre'];

      $objeto=new TipoPavimentoModel();

      $sql="UPDATE tipo_pavimento SET tip_pav_nombre='$tip_nombre' WHERE tip_pav_id=$tip_id";
      $resp=$objeto->update($sql);

      if ($resp) {
        successMsg();
        redirect(getUrl("TipoPavimento","TipoPavimento","index"));
      }else{
        errorMsg();
      }
    }
  }
  function getDelete(){
    $tip_id=$_GET['tip_pav_id'];
    $tip_nombre=$_GET['tip_pav_nombre'];
    include_once '../views/TipoPavimento/delete.php';
  }
  function postDelete(){
    $tip_id=$_POST['tip_pav_id'];
    $sql="DELETE FROM tipo_pavimento WHERE tip_pav_id=$tip_id";

    $objeto=new TipoPavimentoModel();
    $resp=$objeto->delete($sql);

    if ($resp) {
      successMsg();
    }else{
      errorMsg();
    }
    redirect(getUrl("TipoPavimento","TipoPavimento","index"));
  }

  function index(){
    $cantidad=5;
    if (isset($_GET['valor'])) {
      $inicio=$_GET['valor'];
      $inicio=($inicio*$cantidad)-$cantidad;
    }else{
      $inicio=0;
    }
    $objeto= new TipoPavimentoModel();

    $sql= "SELECT * FROM tipo_pavimento LIMIT $cantidad offset $inicio";
    $sql2="SELECT count(*) FROM tipo_pavimento";
    $Tipos=$objeto->consult($sql);
    $cantTipos=$objeto->consult($sql2);
    $cantTipos=pg_fetch_assoc($cantTipos)['count'];

    // variables paginador
    $total_paginas=ceil($cantTipos/$cantidad);
    $urlPaginador=getUrl("TipoPavimento","TipoPavimento","Paginador",false,"ajax");
    include_once '../views/TipoPavimento/index.php';
  }
  function paginador(){
    $cantidad=5;
    if (isset($_POST['valor'])) {
      $inicio=$_POST['valor'];
      $inicio=($inicio*$cantidad)-$cantidad;
    }else{
      $inicio=0;
    }
    $objeto= new TipoPavimentoModel();

    $sql= "SELECT * FROM tipo_pavimento LIMIT $cantidad offset $inicio";
    $tipos=$objeto->consult($sql);

    while ($tipo=pg_fetch_assoc($tipos)) {
      ?>
      <tr>
        <td class="text-center"><?=$tipo['tip_pav_id']?></td>
        <td class="text-center"><?=$tipo['tip_pav_nombre']?></td>
        <td class="text-center">
          <a href="<?=getUrl("TipoPavimento","TipoPavimento","getUpdate",$tipo) ?>" class="btn btn-success btn-round btn-sm" name="button">Editar</a>
          <a href="<?=getUrl("TipoPavimento","TipoPavimento","getDelete",$tipo) ?>" class="btn btn-danger btn-round btn-sm" name="button">Erradicar</a>
        </td>
      </tr>
      <?php
    }

  }


}


?>
