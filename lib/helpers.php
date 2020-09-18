<?php
  session_start();
  function redirect($url){
    ?>
      <script type="text/javascript">
        window.location.href='<?=$url ?>'
      </script>
    <?php
  }

  function dd($var){
    echo "<pre>";
    die(var_dump($var));
  }

  function successMsg(){
    ?><script type="text/javascript">
        alert('Acción exitosa!')
      </script><?php
  }

  function errorMsg(){
    ?><script type="text/javascript">
    alert('Ocurrio un error!')
    </script><?php
  }

  function getUrl($modulo,$controlador,$funcion,$parametro=false,$pagina=false){
    if (!$pagina) {
      $pagina="index";
    }

    $url="$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
    if ($parametro) {
      foreach ($parametro as $key => $value) {
        $url.="&$key=$value";
      }
    }
  
    return $url;
  }

  function resolve(){
    $modulo=ucwords($_GET['modulo']);
    $controlador=ucwords($_GET['controlador']);
    $funcion=$_GET['funcion'];

    if (is_dir("../controller/$modulo")) {
      if (file_exists("../controller/$modulo/$controlador"."Controller.php")) {

        include_once "../controller/$modulo/$controlador"."Controller.php";
        $nombreClase=$controlador."Controller";

        $objeto=new $nombreClase();
        if (method_exists($objeto,$funcion)) {
          $objeto->$funcion();
        }else{
          echo "La funcion especificada no existe";
        }

      }else{
        echo "El controlador especificado no existe";
      }

    }else{
      echo "El modulo especificado no existe";
    }
  }
 ?>
