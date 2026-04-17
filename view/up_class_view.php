<?php


if(isset($_GET['status'])){
    if($_GET['status']='edit'){
        $getId=$_GET['id'];
        $classData=$smsObj->getClass_id($getId);
        $class=mysqli_fetch_assoc($classData);
    }
}
if (isset($_POST['up_class_btn'])) {
    $updateMsg = $smsObj->updateClass($_POST);
}

?>


<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <form action="" method="post">
                    <h5>Update Class</h5>
                    <?php if (isset($updateMsg)) {
                        echo $updateMsg;
                    } ?>
                    <input class="form-control mb-2" type="text" name="up_add_class" value="<?php echo $class['s_class'] ?? '' ;?>" required>
                    <input type="hidden" name="class_id" value="<?php echo $class['s_id'] ?? ''; ?>">
                    <button type="submit" name="up_class_btn" class="btn btn-success w-100">Update Class</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- table -->
    <br>
    
</div>