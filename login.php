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
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $login_error_message = 'Username !';
    } else if ($password == "") {
        $login_error_message = 'Password !';
    } else {
        $user_id = $app->Login($username, $password);
        if($user_id > 0)        {
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php");
        }        else        {
            $login_error_message = 'รายละเอียดไม่ถูกต้อง!';
        }
    }
}



if (!empty($_POST['btnRegister'])) {
    if ($_POST['name'] == "") {
        $register_error_message = 'ชื่อ !';
    } else if ($_POST['lastname'] == "") {
          $register_error_message = 'นามสกุล !';
    } else if ($_POST['username'] == "") {
        $register_error_message = 'ระบุ Username !';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $register_error_message = 'e mail ไม่ถูกต้อง!';
    } else if ($app->isEmail($_POST['email'])) {
          $register_error_message = 'Email มีคนใช้แล้ว!';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'ระบุ Password !';
    } else if ($_POST['confirm-password'] != $_POST['password'] ) {
          $register_error_message = ' Password ไม่ตรงกัน!';
    } else if ($app->isUsername($_POST['username'])) {
        $register_error_message = 'Username มีคนใช้แล้ว!';
    } else {
        $user_id = $app->Register($_POST['name'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password']);
        // set session and redirect user to the profile page
        $_SESSION['user_id'] = $user_id;
        header("Location: index.php");
    }
}

if (!empty($_POST['btnLogout'])) {
  unset($_SESSION['user_id']);
}

?>
<html>
  <head>
    <meta charset="utf-8">
     <title>CHATBOT Project</title>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loginform.css">
    <script type="text/javascript" language="javascript" src="js/loginform.js">
    </script>
    <!------ Include the above in your HEAD tag ---------->
  </head>

  <body>

    <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="login.php" method="post" role="form" >
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
                  <?php
                  if ($login_error_message != "") {
                      echo '<div class="alert alert-danger"><strong>ผิดพลาด: </strong> ' . $login_error_message . '</div>';
                  }
                  ?>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btnLogin" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form"  action="login.php" method="POST" enctype="multipart/form-data"  style="display: none;">
                  <div class="form-group">
										<input type="text" name="name"  class="form-control" placeholder="ชื่อ">
									</div>
                  <div class="form-group">
										<input type="text" name="lastname"  class="form-control" placeholder="นามสกุล">
									</div>
                  <div class="form-group">
                      <input type="text" name="username" placeholder="ระบุ username" class="form-control"/>
                  </div>
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Email Address">
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password"  class="form-control" placeholder="Confirm Password">
									</div>
                  <?php
                  if ($register_error_message != "") {
                      echo '<div class="alert alert-danger"><strong>ผิดพลาด: </strong> ' . $register_error_message . '</div>';
                  }
                  ?>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="btnRegister" id="register-submit" tabindex="7" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	 </div>

  </body>
 </html>
