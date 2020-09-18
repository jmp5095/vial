<?php

/**
 *
 */
class Connection {
  private $server;
  private $user;
  private $pass;
  private $port;
  private $database;
  private $link;

  function __construct()
  {
    $this->setConnect();
    $this->connect();
  }

  private function setConnect(){
    // include "config.php";
    require('config.php');
    $this->server=$server;
    $this->user=$user;
    $this->pass=$pass;
    $this->port=$port;
    $this->database=$database;
  }

  private function connect(){
    $this->link=pg_connect(
      "host=$this->server
       user=$this->user
       dbname=$this->database
       port=$this->port
       password=$this->pass");
    if (!($this->link)) {
      die(pg_errormessage($this->link));
    }else{
       // echo "CONEXION EXITOSA!";
    }
  }

  public function getConnect(){
    return $this->link;
  }

  public function close(){
    return mysqli_close($this->link);
  }
}
