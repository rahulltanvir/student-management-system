<?php
// if (isset($_POST['add_class_btn'])) {
//     $addClass = $smsObj->addClass($_POST);
// }
// $displayClass=$smsObj->displayClassData();

// 
if (isset($_POST['submit'])) {

    $update = $smsObj->updateStudentData($_POST);

    if ($update === "Updated Successfully") {
        $_SESSION['success'] = "Student Updated Successfully!";
        $_SESSION['type']="success";
        header("Location: update_student.php?status=edit&id=" . $_POST['student_id']);
        exit();
    }
}

$displayClass = $smsObj->displayClassData();

if (isset($_GET['status']) && $_GET['status'] == 'delete') {

    $id = $_GET['id'];

    $result = $smsObj->deleteClass($id);

    if ($result === "Deleted Successfully") {
        $_SESSION['success'] = "Class Deleted Successfully!";
        $_SESSION['type'] = "delete";
    } else {
        $_SESSION['success'] = $result;
        $_SESSION['type'] = "error";
    }

    header("Location: class.php");
    exit();
}
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
                            
                            <th class="col-md-2">SL</th>
                            <th class="col-md-7">Class</th>
                            <th class="col-md-3">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i=1; while($addClass_f=mysqli_fetch_assoc($displayClass)){ ?>
                        <tr>
                            
                            <td><?php echo $i++; ?></td>
                            <td><?php if(isset($addClass_f)){ echo $addClass_f['s_class'] ;} ?></td>
                            <td>
                                <a class="btn btn-info" href="up_class.php?status=edit&id=<?php echo $addClass_f['s_id'];?>">Edit</a>
                                <a class="btn btn-danger" href="?status=delete&id=<?php echo $addClass_f['s_id'];?>">Delete</a>
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
<?php if (isset($_SESSION['success'])) { ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

let type = "<?= $_SESSION['type'] ?? 'success' ?>";

let title = "Good job!";
let icon = "success";

if(type === "delete"){
    title = "Deleted!";
    icon = "warning";
}
else if(type === "error"){
    title = "Error!";
    icon = "error";
}
else if(type === "update"){
    title = "Updated!";
    icon = "success";
}

swal({
    title: title,
    text: "<?= $_SESSION['success']; ?>",
    icon: icon,
    button: "OK",
}).then(() => {
    window.location = "class.php";
});

</script>

<?php 
unset($_SESSION['success']);
unset($_SESSION['type']);
} ?>