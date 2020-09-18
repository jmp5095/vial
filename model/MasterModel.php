<?php
include_once '../lib/conf/connection.php';

class MasterModel extends Connection{

  public function insert($sql){
    $result=pg_query($this->getConnect(),$sql);
    return $result;
  }

  public function update($sql){
    $result=pg_query($this->getConnect(),$sql);
    return $result;
  }

  public function delete($sql){
    $result=pg_query($this->getConnect(),$sql);
    return $result;
  }

  public function consult($sql){
    $result=pg_query($this->getConnect(),$sql);
    return $result;
  }

  public function autoincrement($table,$field){
    $sql="SELECT MAX($field) FROM $table";
    $result=$this->consult($sql);
    $id=pg_fetch_row($result);

    return $id[0]+1;
  }
}

 ?>
