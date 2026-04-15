<?php
if (isset($_POST['add_class_btn'])) {
    $addClass = $smsObj->addClass($_POST);
}
$displayClass=$smsObj->displayClassData();

?>


<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <form action="" method="post">
                    <h5>Add Class</h5>
                    <?php if (isset($addClass)) {
                        echo $addClass;
                    } ?>
                    <input class="form-control mb-2" type="text" name="add_class" placeholder="add class" required>
                    <button type="submit" name="add_class_btn" class="btn btn-success w-100">Add Class</button>
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
                <h5>Class List</h5>

                <table class="table table-hover mt-3  w-100 text-center">
                    <thead class="table-dark ">
                        <tr>
                            <th class="col-md-2">ID</th>
                            <th class="col-md-7">Section</th>
                            <th class="col-md-3">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php while($addClass_f=mysqli_fetch_assoc($displayClass)){ ?>
                        <tr>
                            <td><?php if(isset($addClass_f)){ echo $addClass_f['s_id'] ;} ?></td>
                            <td><?php if(isset($addClass_f)){ echo $addClass_f['s_class'] ;} ?></td>
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