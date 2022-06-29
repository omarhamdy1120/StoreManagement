<?php require "assets/function.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php require "assets/autoloader.php" ?>
	<style type="text/css">
	<?php include 'css/customStyle.css'; ?>
	
	</style>
</head>
<body style="background: url('photo/login.jpg'); background-size: cover; background-repeat: no-repeat;">

  <!-- /.login-logo -->
  <div class="well well-sm" style="width: 28%;margin:auto;padding: 25px;margin-top: 160px;z-index: 6; ">
  <h2 class="center" style=" color: white;text-shadow: 2px 2px 4px #000000;">Marco Store Management</h2> <br>
    <p class="login-box-msg">Login</p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="E-mail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Login</button>
    </form>
  </div>
  <br>
  <div class="alert alert-danger" id="error"  style="width: 25%;margin: auto;display: none;"></div>
  <div style="position: fixed;;top:0;background: rgba(0,0,0,0.7); width: 100%;height: 100%;z-index: -1"></div>

  <!-- /.login-box-body -->
</div>
</body>
</html>

<?php 

if (isset($_POST['login'])) 
{
	$user = $_POST['email'];
    $pass = $_POST['password'];
    $con = new mysqli('localhost','root','','store');

    $result = $con->query("select * from users where email='$user' AND password='$pass'");
    if($result->num_rows>0)
    {	
    	session_start();
    	$data = $result->fetch_assoc();
    	$_SESSION['userId']=$data['id'];
      $_SESSION['bill'] = array();
    	header('location:index.php');
      }
    else
    {
     	echo 
     	"<script>
     		\$(document).ready(function(){\$('#error').slideDown().html('Login Error! Try again.').delay(3000).fadeOut();});
     	</script>
     	";
    }
}

 ?>