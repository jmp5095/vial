<?php
include_once '../model/Deterioro/DeterioroModel.php';
include_once '../model/MasterModel.php';
class DeterioroController{

  function getCreate(){
    include_once '../views/Deterioro/create.php';
  }
  function postCreate(){
    if ($_POST['det_nombre']=="" or $_POST['det_descripcion']=="") {
      if ($_POST['det_nombre']=="") {
        $_SESSION['error']['nombre']="Ingrese un nombre por favor.";
      }
      if ($_POST['det_descripcion']=="") {
        $_SESSION['error']['descricion']="Ingrese una descripcion por favor.";
      }
      redirect(getUrl("Deterioro","Deterioro","getCreate"));
    }else{
      $det_nombre=$_POST['det_nombre'];
      $det_descripcion=$_POST['det_descripcion'];

      $objeto=new DeterioroModel();
      $det_id=$objeto->autoincrement("deterioro","det_id");
      $sql="INSERT INTO deterioro (det_id,det_nombre,det_descripcion)VALUES ($det_id,'$det_nombre','$det_descripcion')";
      $resp=$objeto->insert($sql);

      if ($resp) {
        successMsg();
        redirect(getUrl("Deterioro","Deterioro","index"));
      }else{
        errorMsg();
      }
    }

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

      if ($resp) {
        successMsg();
        redirect(getUrl("Deterioro","Deterioro","index"));
      }else{
        errorMsg();
      }

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

    if ($resp) {
      successMsg();
    }else{
      errorMsg();
    }
    redirect(getUrl("Deterioro","Deterioro","index"));
  }
  function index(){
    $cantidad=5;
    if (isset($_GET['valor'])) {
      $inicio=$_GET['valor'];
      $inicio=($inicio*$cantidad)-$cantidad;
    }else{
      $inicio=0;
    }
    $objeto= new DeterioroModel();

    $sql= "SELECT * FROM deterioro ORDER BY det_id LIMIT $cantidad offset $inicio";
    $sql2="SELECT count(*) FROM deterioro";
    $deterioros=$objeto->consult($sql);
    // variables paginador
    $urlPaginador=getUrl("Deterioro","Deterioro","paginador",false,"ajax");
    $cantDeterioro=$objeto->consult($sql2);
    $cantDeterioro=pg_fetch_assoc($cantDeterioro)['count'];
    $total_paginas=ceil($cantDeterioro/$cantidad);

    include_once '../views/Deterioro/index.php';
  }
  function paginador(){
    $cantidad=5;
    if (isset($_POST['valor'])) {
      $inicio=$_POST['valor'];
      $inicio=($inicio*$cantidad)-$cantidad;
    }else{
      $inicio=0;
    }
    $objeto= new DeterioroModel();

    $sql= "SELECT * FROM deterioro LIMIT $cantidad offset $inicio";
    $deterioros=$objeto->consult($sql);

    while ($deterioro=pg_fetch_assoc($deterioros)) {
      ?>
      <tr>
        <td class="text-center"><?=$deterioro['det_id']?></td>
        <td class="text-center"><?=$deterioro['det_nombre']?></td>
        <td class="text-center"><?=$deterioro['det_descripcion']?></td>
        <td class="text-center">
          <a href="<?=getUrl("Deterioro","Deterioro","getUpdate",$deterioro) ?>" class="btn btn-success btn-round btn-sm" name="button">Editar</a>
          <a href="<?=getUrl("Deterioro","Deterioro","getDelete",$deterioro) ?>" class="btn btn-danger btn-round btn-sm" name="button">Erradicar</a>
        </td>
      </tr>
      <?php
    }

  }

}

 ?>
