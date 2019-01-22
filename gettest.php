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

$chatDe=$app->get_msg($_SESSION['user_id']);

?>

<!------------------------------------------->
<?php
echo "USER : ".$user->name."<br />";
if($ans!=''){
echo "ANS = ".$ans->ans;
}else {
echo "ANS = ไม่เข้าใจ";
}

$dataList = $app->get_msg($_SESSION['user_id']);

        echo'
        <div class="table-responsive">
          <table id="mytable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ลำดับล่าสุด</th>
                <th>user_id</th>
                <th>message</th>
                <th>time</th>
                <th>type</th>
              </tr>
            </thead>
            <tbody>
            ';
          foreach($dataList as $dataTable) {
            echo "<tr>";

            echo '<td align="center">';
            echo $dataTable[0]; echo " "; //1
            echo "</td>";
            echo '<td align="center">';
            echo $dataTable[1]; echo " "; //2
            echo "</td>";
            echo '<td align="center">';
            echo $dataTable[2]; echo " "; //3
            echo "</td>";
            echo '<td align="center">';
            echo $dataTable[3]; echo " "; //3
            echo "</td>";
            echo '<td align="center">';
            echo $dataTable[4]; echo " "; //3
            echo "</td>";

            echo "</tr>";
            echo "</tbody>";

          } // ./ปิด foreach.


      echo '</table>
            </div>';
 ?>

<!------------------------------------------->
<form action="gettest.php" method="post">
  <div class="form-group">
      <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
  </div>
  <div class="form-group">
  <label>Enter Message: <input type="text" name="message" /></label>
  <input type="submit" name="send" value="Send Message"/>
</div>
</form>
