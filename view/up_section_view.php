<?php 
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $upSectionData=$smsObj->getSection_id($id);
    $upSectionData_f=mysqli_fetch_assoc($upSectionData);
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
                    <?php if(isset($sectionData)){ echo $sectionData;}?>
                    
                    <input class="form-control mb-2" type="text" name="up_section" value="<?php echo $upSectionData_f['s_section']??''; ?>" required>
                    <input type="hidden" name="section_id" value="<?php echo $upSectionData_f['id']??''; ?>">
                    <button type="submit" name="up_section" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- table -->
</div>