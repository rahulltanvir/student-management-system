<?php 
if(isset($_GET['status'])){
    if($_GET['status']='edit'){
        $getId=$_GET['id'];
        $upSession_data=$smsObj->getSession_id($getId);
        $upSession_data_f=mysqli_fetch_assoc($upSession_data);
    }
}
if(isset($_POST['up_session_btn'])){
    $upSessionmsg=$smsObj->updateSession($_POST);
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <h5>Update Session</h5>
                <?php if(isset($upSessionmsg)){ echo $upSessionmsg; } ?>
                <form action="" method="post">
                    <input type="" class="form-control mb-2" name="up_session" value="<?php echo $upSession_data_f['s_session'] ?>" required>
                    <input type="hidden" class="form-control mb-2" name="session_id" value="<?php echo $upSession_data_f['id'] ?>" required>

                    <button type="submit" name="up_session_btn" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>