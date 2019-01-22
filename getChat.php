<?php
$question = '';
$question = $_GET["message"];

//1. insert $question to

//2. Select TOP 1 answer FROM chat WHERE que = '$question'

//3. echo ค่าที่ query ออกมา;
?>
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
$ans = '';
$type= '';

if ($question!='') {
        $_POST['type'] = 'HUMAN';
        $_POST['message'] = $question;
        $_POST['user_id'] = $user->user_id;
        $app->send_msg($_POST['user_id'],$_POST['message'],$_POST['type']);
        $ans = $app->get_ans($_POST['message']);
        if ($ans!='') {
          $_POST['message'] = $ans->ans;
          $_POST['type'] = 'BOT';
          $app->send_msg($_POST['user_id'],$_POST['message'],$_POST['type']);
          echo $ans->ans;
        }else {
          echo "ฉันไม่เข้าใจ";

        }
  }



?>
