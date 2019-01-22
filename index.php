<?php
session_start();
require __DIR__ . '/database.php';
$db = DB();
require __DIR__ . '/lib/library.php';
$app = new myLib();

$login_error_message = '';
$login_error_message2 = '';
error_reporting( error_reporting() & ~E_NOTICE );
$user=$app->UserDetails($_SESSION['user_id']);

if (!empty($_POST['btnLogin'])) {
  header("Localhost:login.php");
}

if (!empty($_POST['btnLogout'])) {
  unset($_SESSION['user_id']);
}

?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
  <title> หน้าหลัก </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/shCore.css">
  <style type="text/css" class="init">
</style>

<script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js">
</script>

</script>
<script type="text/javascript" language="javascript" src="js/shCore.js">
</script>
<script type="text/javascript" language="javascript" src="js/demo.js">
</script>


    <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->

      <script src="./js/bootstrap.min.js"></script>
      <script src="./js/docs.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="./js/ie10-viewport-bug-workaround.js"></script>

    </head>

    <body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CHATBOT : DEMO</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">



            <!--------------------------------------------------------------------------------------------->
            <!--------------------------------------------------------------------------------------------->

            <?php

            $sessionValue = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            if($sessionValue==''){
              echo'  <form class="navbar-form navbar-right ">
              <div class="form-group">
              <input type="button" name="btnRegister" value="เข้าสู่ระบบ"
              class="form-control btn btn-success" onclick="parent.location.href=\'login.php\';" >
              </div>
              </form>
              ';
            }else{
              echo'  <form class="navbar-form navbar-right  " action="index.php" method="post">
              <div class="form-group">
              <p><h4><font color="white">สวัสดีคุณ '; echo $user->name." ".$user->lastname; echo'</font></h4></p>
              </div>
              <div class="form-group">
              '; if ($user->username == 'admin') {
                echo '<input type="button" name="btnData" value="Event"
                class="btn btn-light" onclick="parent.location.href=\'insertQA.php\';" >';
              }
              echo'
              <input type="button" name="btnData" value="ข้อมูล"
              class="btn btn-primary" onclick="parent.location.href=\'profile.php\';" >
              <input type="submit" name="btnLogout" class="btn btn-success" value="ออกจากระบบ"/>
              </div>

              </form>';
            }
            ?>
          </div><!--/.navbar-collapse -->
        </div>
      </nav>

      <!--------------------------------------------------------------------------------------------->

      <?php
      $sessionValue2 = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
      if($sessionValue2==''){
        echo'
        <div class="row">
        <div class="col-md-12">
        <h2>
        <div class="row">
        <div class="col-md-12">
        <h2>

        </h2>
        </div>
        </div>
        </h2>
        </div>
        </div>
        <div class="row">
        <div class="container">
        <div class="col-md-12">

        <div class="panel panel-info">
        <div class="panel-heading"><center><h3>THE CHATBOT DEMO</h3></center><br>
        <center><h5>Please Login To Show CHATBOX ! </h5></center>
        </div>
        </div>
        </div>
        </div>

        ';}
        else{
        
          include './include/chatbox.php';

        }

        ?>

      </body>
      </html>
