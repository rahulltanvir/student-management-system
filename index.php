<?php
session_start();
include("function/function.php");
$smsObj= new studnet_management();
$error ="";
if(!isset($_SESSION['token'])){
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit'])){
  if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
    die("Invalid CSRF token");
  }
  $loginData=$smsObj->userLogin($_POST);
  if($loginData === true){
    header("location: dashboard.php");
    exit();
  }else {
        $error = $loginData; // show error
    }
}
  if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stylish Login</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body class="cssbody">

<!-- LOGIN BOX -->
<div class="login-box">

  <h2>Login</h2> <!-- ✔ clean title -->

  <form action="" method="post" enctype="multipart/form-data">
    <?php
if(!empty($error)){
    echo "<p style='color:red;'>$error</p>";
}
?>
    <input type="hidden" name="token" value="<?php if(isset($_SESSION))echo $_SESSION['token']; ?>">
<?php if(isset($_SESSION['error'])): ?>
    <p style="color:red;">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>
    <div class="input-box">
      <span>👤</span>
      <input type="email" placeholder="Username" name="email">
    </div>

    <div class="input-box">
      <span>🔒</span>
      <input type="password" placeholder="Password" name="std_pass">
    </div>

    <button type="submit" name="submit">Login</button>

  </form>

</div>

</body>
</html>