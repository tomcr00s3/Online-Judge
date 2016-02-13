<?php

	require_once('../functions.php');
	if(loggedin() and $_SESSION['username'] == 'admin')
		header("Location: index.php");
	else if(isset($_POST['password'])) {
		if(trim($_POST['password']) == "")
			header("Location: login.php?derror=1"); // empty entry
		else {
			// code to login the user and start a session
			connectdb();
			$query = "SELECT salt,hash FROM users WHERE username='admin'";
			$result = mysql_query($query);
			$fields = mysql_fetch_array($result);
			$currhash = crypt($_POST['password'], $fields['salt']);
			if($currhash == $fields['hash']) {
				$_SESSION['username'] = "admin";
				header("Location: index.php");
			} else
				header("Location: login.php?error=1");
		}
	}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Onlinejudge Admin Panel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
        bottom: 0;
      }
      .admin_login_form{
        width: 300px;
        margin: 0 auto;
        height:460px;
        margin-top:40px;
      }
      .wrapper{
          margin-top: 80px;
          margin-bottom: 80px;
      }
      .form-signin{
        max-width: 380px;
        padding: 15px 35px 45px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.1); 
      }
      .form-signin .form-siginin-heading{
        margin-bottom: 30px;
      }
      .form-signin .form-control{
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="password"] {
        margin-bottom: 20px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
      .back_img{
       /*background: #eee !important;*/
        background: url(../assets/back.jpg);
        background-repeat:no-repeat; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Onlinejudge</a>
        </div>
      </div>
    </div>
    <div class = "back_img">
        <div class="container">

          <?php
            if(isset($_GET['logout']))
              echo("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
            else if(isset($_GET['error']))
              echo("<div class=\"alert alert-error\">\nIncorrect Password!\n</div>");
            else if(isset($_GET['derror']))
              echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
          ?>
             <div class = "wrapper">
                <div class = "admin_login_form">
                  <form method="post" action="login.php" class = "form-signin">
                    <h2 class = "form-siginin-heading">Login</h2>
                    <p>Please login to use the admin panel.</p><br/>
                    Password: <input class = "form-control" type="password" name="password" placeholder = "Password" required = ""/><br/><br/>
                    <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login"/>
                  </form>
                </div>
            </div>
        </div> <!-- /container -->
    </div>
<?php
	include('footer.php');
?>
