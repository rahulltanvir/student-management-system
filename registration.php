<?php
session_start();
include("function/function.php");
include("function/auth.php");
$stdManagementObj = new studnet_management();


if (isset($_POST['registration'])) {
    $result = $stdManagementObj->registration($_POST);

    if ($result === true) {
        $_SESSION['success'] = "Registration successful!";
    } else {
        $_SESSION['error'] = $result;
    }

    header("Location:registration.php");
    exit();
}


?>
<?php include("include/head.php") ?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>

        <div class="col-md-8">
            <div class="box">

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <h1>Student Management Admin Register</h1>
                        <br>
                        <p>Please fill in this form to create an account.</p>
                        <hr>
                        <?php if (isset($_SESSION['error'])): ?>
                            <p style="color:red;"><?php echo $_SESSION['error'];
                                                    unset($_SESSION['error']); ?></p>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['success'])): ?>
                            <p style="color:green;"><?php echo $_SESSION['success'];
                                                    unset($_SESSION['success']); ?></p>
                        <?php endif; ?>
                        <label for="email"><b>Email</b></label><br>
                        <input class="form-control mb-2" type="text" placeholder="Enter Email" name="email" id="email" required><br>

                        <label for="psw"><b>Password</b></label><br>
                        <input class="form-control mb-2" type="password" placeholder="Enter Password" name="psw" id="psw" required><br>

                        <label for="psw-repeat"><b>Repeat Password</b></label><br>
                        <input class="form-control mb-2" type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required><br>

                        <button type="submit" name="registration" class="registerbtn">Register</button><br>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>

    </div>
</div>