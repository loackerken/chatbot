<?php
session_start();
if(!empty($_SESSION['user_id'])) {
  header("localhost:index.php");
}

require __DIR__.'/database.php';
$db=DB();
require __DIR__.'/lib/library.php';
$app=new myLib();
$user=$app->UserDetails($_SESSION['user_id']);
$dataList = '';
$dataList = $app->get_msg($_SESSION['user_id']);


if($dataList!= ''){
foreach ($dataList as $dataTable) {
  echo $dataTable[2];
  echo " % ";
  echo $dataTable[3];
  echo " % ";
  echo $dataTable[4];
  echo " | ";
}
}
?>
