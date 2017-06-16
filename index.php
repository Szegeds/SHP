<?php
session_start();


$msg = "";
if($_POST) {
 	$login = $_POST['login'];
	$pw = $_POST['pswd'];
	if(($login == "admin") && ($pw == "abc456")) {
		$_SESSION['admin'] = "admin";
		header("location: pages/admin/product.php");
		exit;		
	}
	else {
 		$msg = 'Login หรือ Password ไม่ถูกต้อง'; 
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Store</title>
<style>
	img {
		height: 300px;
		display: block;
   		margin: auto;
	}
</style>
<link rel="stylesheet" href="_assets/bootstrap-4.0.0-alpha.6/dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="_assets/bootstrap-4.0.0-alpha.6/dist/css/bootstrap-reboot.min.css">
<link rel="stylesheet" href="_assets/bootstrap-4.0.0-alpha.6/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="_assets/font-awesome-4.7.0/css/font-awesome.min.css">


<!-- <script src="../../js/jquery-3.2.1.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="_assets/tether-master/dist/js/tether.min.js"></script>
<script src="_assets/bootstrap-4.0.0-alpha.6/dist/js/bootstrap.min.js"></script>

</head>

<body>
<?php include "pages/include/include_web.php"; ?>
<img src="images/data-store.jpg"><br>
<div class="warn"><?php echo $msg; ?></div>


<div class="container">
<form method="post">
    <div class="form-group row">
      <label for="inputEmail3" class="offset-sm-2 col-sm-2 col-form-label">Username</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="login" placeholder="Username" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="offset-sm-2 col-sm-2 col-form-label">Password</label>
      <div class="col-sm-4">
        <input type="password" class="form-control" name="pswd" placeholder="Password" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-4"></label>
      <div class="col-sm-4">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox"> Remember me
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-4 col-sm-8">
        <button type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>