<?php 
if(isset($_POST['Add_section_data'])){
    $sectionData=$smsObj->addSection($_POST);
}
$sectionDisplay=$smsObj->displaySection();

?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <form action="" method="post">
                    <h5>Add Section</h5>
                    <?php if(isset($sectionData)){ echo $sectionData;}?>
                    <input class="form-control mb-2" type="text" name="add_section" placeholder="add section" required>
                    <button type="submit" name="Add_section_data" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- table -->
    <br>
    <div class="row">
        <div class="col-md-1">
        </div>

        <div class="col-md-10">
            <div class="box">
                <h5>Section List</h5>

                <table class="table table-hover mt-3  w-100 text-center">
                    <thead class="table-dark ">
                        <tr>
                            <th class="col-md-2">ID</th>
                            <th class="col-md-7">Section</th>
                            <th class="col-md-3">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php while($sectionDisplay_f=mysqli_fetch_assoc($sectionDisplay)){ ?>
                        <tr>
                            <td><?php echo $sectionDisplay_f['id']; ?></td>
                            <td><?php echo $sectionDisplay_f['s_section']; ?></td>
                            <td>
                                <a class="btn btn-info" href="">Edit</a>
                                <a class="btn btn-danger" href="">Delete</a>
                            </td>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-1">
        </div>
    </div>
</div>