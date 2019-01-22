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

if (!empty($_POST['send'])) {
        $_POST['type'] = 'HUMAN';
        $app->send_msg($_POST['user_id'],$_POST['message'],$_POST['type']);
        $ans = $app->get_ans($_POST['message']);
        if ($ans!='') {
          $_POST['message'] = $ans->ans;
          $_POST['type'] = 'BOT';
          $app->send_msg($_POST['user_id'],$_POST['message'],$_POST['type']);
        }
  }

?>

<!------------------------------------------->
<?php
echo "USER : ".$user->name."<br />";
if($ans!=''){
echo "ANS = ".$ans->ans;
}else {
echo "ANS = ไม่เข้าใจ";
}
 ?>
