<?php 

if(isset($_GET['status'])){
    if($_GET['status']='edit'){
        $getId=$_GET['id'];
        $upSectionData=$smsObj->getSection_id($getId);
        $upSectionData_f=mysqli_fetch_assoc($upSectionData);
    }
}
if(isset($_POST['update_section'])){
    $upSectionmsg=$smsObj->updateSection($_POST);
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <form action="" method="post">
                    <h5>Update Section</h5>
                    <?php if(isset($upSectionmsg)){ echo $upSectionmsg;}?>
                    
                    <input class="form-control mb-2" type="text" name="up_add_section" value="<?php echo $upSectionData_f['s_section']??''; ?>" required>
                    <input type="hidden" name="section_id" value="<?php echo $upSectionData_f['id']??''; ?>">
                    <button type="submit" name="update_section" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- table -->
</div>