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
                <br />
            </h2>
        </div>
    </div>

    <div class="row">

      <div class="col-md-12">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe width="860" height="480" allow="microphone;" class="embed-responsive-item" src="https://console.dialogflow.com/api-client/demo/embedded/30620947-7234-45b3-b153-0ab936fc9331" allowfullscreen></iframe>
        </div>
      </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
   </body>
 </html>
