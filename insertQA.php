<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header("location:index.php");
}
require __DIR__ . '/database.php';
$db = DB();
require __DIR__ . '/lib/library.php';
$app = new myLib();

$error_message = '';
$error_message2 = '';

error_reporting( error_reporting() & ~E_NOTICE );
$user=$app->UserDetails($_SESSION['user_id']);

if (!empty($_POST['btnLogout'])) {
  unset($_SESSION['user_id']);
}

if (!empty($_POST['btnSumbitQA'])){
  if ($_POST['question'] == "") {
      $error_message = 'กรุณาระบุ Question !';
      $error_message2 = '';

  } else if ($_POST['answer'] == "") {
      $error_message = 'กรุณาระบุ Answer !';
      $error_message2 = '';
  } else {
      $app->insertQA($_POST['question'],$_POST['answer']);
      $error_message = '';
      $error_message2 = 'บันทึกข้อมูลเรียบร้อยแล้ว !';
  }
}

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
     <title>CHATBOT Project</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/shCore.css">

    <style type="text/css" class="init">
    </style>

    <script type="text/javascript" language="javascript" src="js/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js">
    </script>
    <script type="text/javascript" language="javascript" src="js/shCore.js">
    </script>
    <script type="text/javascript" language="javascript" src="js/demo.js">
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript" language="javascript" class="init">
      $(document).ready(function() {
        $('#mytable').DataTable({
          "pageLengt0h":5}
        );
      } );
      </script>
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

  <div class="row">
      <div class="col-md-12">
          <h2>
            <div class="row">
                <div class="col-md-12">
                    <h2>
                      <br />
                    </h2>
                </div>
            </div>
          </h2>
      </div>
  </div>
    <div class="row">
      <div class="container">
      <div class="col-md-12">
        <!---------------------------------------------------------------------->
        <?php
        $sessionValue2 = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
         if($sessionValue2==''){
      echo'  <div class="panel panel-info">
          <div class="panel-heading"><center><h3>THE SYSTEM CHATBOT DEMO 2018</h3></center><br>
          <center><h5>Please Login To Show Data ! </h5></center>
          </div>';}
          else{
      echo'   <div class="panel panel-info">
          <div class="panel-heading"><center><h3>EVENT RESPONSE</h3></center>
          </div>
          <div class="panel-body" align="center">

            <!---------------------------------------------------->

            ';
            ?>
            <?php


//----------------------------------------TABLE--------------------------------------------------------
          $dataList = $app->detail_QA();

        echo'

        <div class="table-responsive">
          <table id="mytable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>อันดับล่าสุด</th>
                <th>HUMAN</th>
                <th>BOT</th>
              </tr>
            </thead>
            <tbody>
        ';
          foreach($dataList as $dataTable) {
            echo "<tr>";
            echo '<td width="91">';
            echo $dataTable[0]; echo " "; //1
            echo "</td>";
            echo "<td>";
            echo $dataTable[1]; echo " "; //2
            echo "</td>";
            echo "<td>";
            echo $dataTable[2]; echo " "; //2
            echo "</td>";
            echo "</tr>";

          } // ./ปิด foreach.


      echo'    </table>
              </div>';
//--------------------------------------TABLE--------------------------------------------------------


};

?>
<?php if ($user->username == 'admin') { echo'


</div>
</div>
<div class="row">
  <div>
    <div class="col-sm-12 well">
      ';
      if($error_message !=""){
        echo '<div class="alert alert-danger"><strong>ผิดพลาด: </strong> ' . $error_message . '</div>';
      }
      if($error_message2 !=""){
        echo '<div class="alert alert-success"><strong> ' . $error_message2 . '</strong></div>';
      }
      echo '
      <form action="insertQA.php" method="POST">
        <div class="form-group">
          <div class="col-md-6">
            <input type="text" name="question" placeholder="HUMAN" class="form-control form-control-lg"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <input type="text" name="answer" placeholder="BOT" class="form-control form-control-lg"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-3">
            <label for="colFormLabelLg" class="col-form-label col-form-label-lg">:: PLEASE ENTER THE CONVERSATION INFORMATION ::</label>
          </div>
        </div>
        <div class="form-group">
        <div>
          <div class="col-sm-6 col-sm-offset-3">
            <input type="submit" name="btnSumbitQA" class="form-control btn btn-success" value="INSERT">
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

';
}
?>


<div class="footer navbar-fixed-bottom">
<div class="container-fluid container-fixed-lg footer">
        <div class="copyright sm-text-center">
              <p class="small no-margin pull-left sm-pull-reset">
                          <span class="hint-text">Copyright © 2018</span>
                          <span class="font-montserrat">Project</span>
                          <span class="hint-text">Ubonratchatani Rajabhat University </span>
              </p>
              <p class="small no-margin pull-right sm-pull-reset">
                          <span class="hint-text"> Chatbot DEMO 2018</span>
              </p>
            <div class="clearfix"></div>
        </div>
    </div>
  </div>
  </body>
</html>
