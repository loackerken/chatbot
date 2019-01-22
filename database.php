<?php
define('HOST','Localhost') ;
define('USER','root');
define('PASSWORD','');
define('DATABASE','datatest');
//-------------------------------------//
function DB() {
  try {
     $db=new PDO('mysql:host='.HOST.';dbname='.DATABASE.'',USER,PASSWORD);
     $db->exec("SET CHARACTER SET utf8");
     return $db;
  }catch(PDOException $e) {
  return"ผิดพลาด". $e->getMessage();

  }  // --ปิดtry.
}// -- ปิด function DB ()
 ?>
