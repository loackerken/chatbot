<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  header("location:index.php");
}

require __DIR__ . '/database.php';
$db = DB();
require __DIR__ . '/lib/library.php';
$app = new myLib();
$user=$app->UserDetails($_SESSION['user_id']);

$register_error_message = '';
$ext = '';
$new_image_name  = '';
$image_path = '';
$upload_path = '';


if (!empty($_POST['btnSaveEdit'])) {
    if ($_POST['name'] == "") {
        $register_error_message = 'ชื่อ !';

    } else if ($_POST['lastname'] == "") {
          $register_error_message = 'นามสกุล !';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $register_error_message = 'e mail ไม่ถูกต้อง!';
    } else if ($_POST['password'] == "") {
            $register_error_message = 'ระบุ Password !';
    } else if ($_POST['confirm-password'] != $_POST['password'] ) {
            $register_error_message = ' Password ไม่ตรงกัน!';
    } else {

        $app->Edituser($_POST['user_id'],$_POST['name'],$_POST['lastname'],$_POST['email'], hash('sha256',$_POST['password']));

         header("Location: profile.php");
    }
}

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
                  แก้ไขข้อมูล<br>

              </h4></center>
              <div class="panel panel-default">
    						<div class="panel-heading">USER ID : <?php echo $user->user_id; ?> THE CHATBOT DEMO</div>

    					</div>
          </div>


          <?php
          if ($register_error_message != "") {
              echo '<div class="alert alert-danger"><strong>ผิดพลาด: </strong> ' . $register_error_message . '</div>';
          }
          ?>
            <form action="editprofile.php" method="POST">
              <div class="form-group">
                  <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
              </div>
              <div class="form-group">
                  <label for="">Username : <?php echo $user->username; ?></label>

              </div>
                <div class="form-group">
                    <label for="">ชื่อ</label>
                    <input type="text" name="name" value="<?php echo $user->name; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">นามสกุล</label>
                    <input type="text" name="lastname" value="<?php echo $user->lastname; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="ระบุ Password" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">ยืนยัน Password</label>
                    <input type="password" name="confirm-password" placeholder="ยืนยัน Password" class="form-control"/>
                </div>


                <div class="form-group" align="center">
                    <input type="submit" name="btnSaveEdit" value="ยืนยัน" align="center"
                    class="btn btn-lg btn-warning" >
                    <input type="button" name="btnOk" value="ยกเลิก" align="center"
                    class="btn btn-lg btn-primary" onclick="parent.location.href='profile.php';" >
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
