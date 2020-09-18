<?php
include_once '../model/Comuna/ComunaModel.php';
include_once '../model/MasterModel.php';
class ComunaController{

  function getCreate(){
    include_once '../views/Comuna/create.php';
  }
  function postCreate(){
    if ($_POST['com_nombre']=="") {
      $_SESSION['error']['nombre']="Ingrese un nombre por favor.";
      redirect(getUrl("Comuna","Comuna","index"));
    }else{
      $com_nombre=$_POST['com_nombre'];

      $objeto=new ComunaModel();
      $com_id=$objeto->autoincrement("comuna","com_id");
      $sql="INSERT INTO comuna (com_id,com_nombre)VALUES ($com_id,'$com_nombre')";
      $resp=$objeto->insert($sql);

      if ($resp) {
        $sql= "SELECT * FROM comuna ORDER BY com_id";
        $comunas=$objeto->consult($sql);

        while ($comuna=pg_fetch_assoc($comunas)){
          ?>
          <tr>
            <td class="text-center"><?=$comuna['com_id']?></td>
            <td class="text-center"><?=$comuna['com_nombre']?></td>
            <td class="text-center">
              <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
              accion="actualizar"
              data-id="<?=$comuna['com_id']?>"
              data-nombre="<?=$comuna['com_nombre']?>"
              data-url="<?=getUrl("Comuna","Comuna","postUpdate",false,"ajax")?>">
                Editar
              </a>
              <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
              accion="eliminar"
              data-id="<?=$comuna['com_id']?>"
              data-nombre="<?=$comuna['com_nombre']?>"
              data-url="<?=getUrl("Comuna","Comuna","postDelete",false,"ajax")?>">
                Erradicar
              </a>
            </td>
          </tr>
          <?php
        }


      }else{
        errorMsg();
      }
    }

  }
  function getUpdate(){
    $com_id=$_GET['com_id'];
    $com_nombre=$_GET['com_nombre'];
    include_once '../views/Comuna/update.php';
  }
  function postUpdate(){
    if ($_POST['com_nombre']=="") {
      $_SESSION['error']['nombre']="Ingrese un nombre porfavor";
      $comuna=array(
        'com_id' => $_POST['com_id'],
        'com_nombre' => $_POST['com_nombre_actual']
      );
      redirect(getUrl("Comuna","Comuna","getUpdate",$comuna));
    }else{
      $com_id=$_POST['com_id'];
      $com_nombre=$_POST['com_nombre'];
      $objeto=new ComunaModel();

      $sql="UPDATE comuna SET com_nombre='$com_nombre' WHERE com_id=$com_id";
      $resp=$objeto->update($sql);

      if ($resp) {
        $sql= "SELECT * FROM comuna ORDER BY com_id";
        $comunas=$objeto->consult($sql);

        while ($comuna=pg_fetch_assoc($comunas)){
          ?>
          <tr>
            <td class="text-center"><?=$comuna['com_id']?></td>
            <td class="text-center"><?=$comuna['com_nombre']?></td>
            <td class="text-center">
              <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
              accion="actualizar"
              data-id="<?=$comuna['com_id']?>"
              data-nombre="<?=$comuna['com_nombre']?>"
              data-url="<?=getUrl("Comuna","Comuna","postUpdate",false,"ajax")?>">
                Editar
              </a>
              <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
              accion="eliminar"
              data-id="<?=$comuna['com_id']?>"
              data-nombre="<?=$comuna['com_nombre']?>"
              data-url="<?=getUrl("Comuna","Comuna","postDelete",false,"ajax")?>">
                Erradicar
              </a>
            </td>
          </tr>
          <?php
        }


      }else{
        errorMsg();
      }
    }
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

    if ($resp) {
      $sql= "SELECT * FROM comuna ORDER BY com_id";
      $comunas=$objeto->consult($sql);

      while ($comuna=pg_fetch_assoc($comunas)){
        ?>
        <tr>
          <td class="text-center"><?=$comuna['com_id']?></td>
          <td class="text-center"><?=$comuna['com_nombre']?></td>
          <td class="text-center">
            <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-success btn-round btn-sm text-white"
            accion="actualizar"
            data-id="<?=$comuna['com_id']?>"
            data-nombre="<?=$comuna['com_nombre']?>"
            data-url="<?=getUrl("Comuna","Comuna","postUpdate",false,"ajax")?>">
              Editar
            </a>
            <a id="accionarModal" data-toggle="modal" data-target="#modal" class="btn btn-danger btn-round btn-sm text-white"
            accion="eliminar"
            data-id="<?=$comuna['com_id']?>"
            data-nombre="<?=$comuna['com_nombre']?>"
            data-url="<?=getUrl("Comuna","Comuna","postDelete",false,"ajax")?>">
              Erradicar
            </a>
          </td>
        </tr>
        <?php
      }


    }else{
      errorMsg();
    }
  }
  function index(){
    $objeto= new ComunaModel();

    $sql= "SELECT * FROM comuna ORDER BY com_id";
    $comunas=$objeto->consult($sql);


    include_once '../views/Comuna/index.php';
  }


}

 ?>
