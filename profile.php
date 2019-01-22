<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header("location:index.php");
}

require __DIR__.'/database.php';
$db=DB();
require __DIR__.'/lib/library.php';
$app=new myLib();
$user=$app->UserDetails($_SESSION['user_id']);


 ?>

 <!doctype html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
      <title>CHATBOT Project</title>
     <link rel="stylesheet" href="css/bootstrap.min.css">

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

             <form class="navbar-form navbar-right  " action="index.php" method="post">

             <div class="form-group">
                       <p><h4><font color="white">สวัสดีคุณ <?php echo $user->name; echo " "; echo $user->lastname; ?> </font></h4></p>
             </div>
             <div class="form-group">

                       <input type="button" name="btnData" value="ข้อมูล"
                       class="btn btn-primary" onclick="parent.location.href='profile.php';" >
                       <input type="submit" name="btnLogout" class="btn btn-success" value="ออกจากระบบ"/>
             </div>
            </form>
         </div><!--/.navbar-collapse -->
       </div>
     </nav>
<!------------------------------------------------------------------------>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <br>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 well">
          <div class="col-md-12">
              <center><h4>
                  ข้อมูลสมาชิก<br>

              </h4></center>
              <div class="panel panel-default">
    						<div class="panel-heading">USER ID : <?php echo $user->user_id; ?> THE CHATBOT DEMO</div>
    					</div>
          </div>



            <form action="profile.php" method="POST">
              <div class="form-group">
                  <label for="">Username : <?php echo $user->username; ?></label>
              </div>
              <div class="form-group">
                  <label for="">E-mail : <?php echo $user->email; ?></label>
              </div>
                <div class="form-group">
                    <label for="">ชื่อ : <?php echo $user->name; ?></label>
                </div>
                <div class="form-group">
                    <label for="">นามสกุล : <?php echo $user->lastname; ?></label>
                </div>
                <div class="form-group" align="center">
                    <input type="button" name="btnEdit" value="แก้ไขข้อมูล" align="center"
                    class="btn btn-lg" onclick="parent.location.href='editprofile.php';" >
                    <input type="button" name="btnOk" value="ตกลง" align="center"
                    class="btn btn-lg btn-primary" onclick="parent.location.href='index.php';" >
                    <input type="button" name="btn" value="แสดง" align="right"
                    class="btn btn-lg btn btn-danger" onclick="parent.location.href='iframeDialogflow.php';">
                </div>
            </form>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
   </body>
 </html>
