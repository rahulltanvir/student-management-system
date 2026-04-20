<?php
// if(isset($_POST['Add_section_data'])){
//     $sectionData=$smsObj->addSection($_POST);
// }
if (isset($_POST['Add_section_data'])) {
    $sectionData = $smsObj->addSection($_POST);

    if ($sectionData === "success") {
        $_SESSION['success'] = "Class Added Successfully!";
        header("Location:section.php");
        exit();
    }
}
$sectionDisplay = $smsObj->displaySection();

if (isset($_GET['status']) && $_GET['status'] == 'delete') {
    $id = $_GET['id'];
    $deleteSectionData = $smsObj->deleteSection($id);
    if ($deleteSectionData === 'Deleted Successfully') {
        $_SESSION['success'] = "Section Deleted Successfully!";
        $_SESSION['type'] = "delete";
    } else {
        $_SESSION['success'] = $deleteSectionData;
        $_SESSION['type'] = 'error';
    }
    header("location: section.php");
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
                    <h5>Add Section</h5>

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
                        <?php while ($sectionDisplay_f = mysqli_fetch_assoc($sectionDisplay)) { ?>
                            <tr>
                                <td><?php echo $sectionDisplay_f['id']; ?></td>
                                <td><?php echo $sectionDisplay_f['s_section']; ?></td>
                                <td>
                                    <a class="btn btn-info" href="up_section.php?status=edit&id=<?php echo $sectionDisplay_f['id']; ?>">Edit</a>
                                    <a
                                        class="btn btn-danger"
                                        href="?status=delete&id=<?php echo $sectionDisplay_f['id']; ?>"
                                        onclick="return confirmDelete(event, this.href)">
                                        Delete
                                    </a>
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

    <?php if (isset($_SESSION['success'])) { ?>
<script>
let type = "<?= $_SESSION['type'] ?? 'success' ?>";

let title = "Good job!";
let icon = "success";

if (type === "delete") {
    title = "Deleted!";
    icon = "warning";
} else if (type === "error") {
    title = "Error!";
    icon = "error";
} else if (type === "update") {
    title = "Updated!";
    icon = "success";
}

swal({
    title: title,
    text: "<?= $_SESSION['success']; ?>",
    icon: icon,
    button: "OK",
}).then(() => {
    window.location = "section.php";
});
</script>

<?php
unset($_SESSION['success']);
unset($_SESSION['type']);
} ?>

<script>
function confirmDelete(event, url){
    event.preventDefault();

    swal({
        title: "Are you sure?",
        text: "You want to delete this section!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url;
        }
    });
}
</script>
<?php
    unset($_SESSION['success']);
    unset($_SESSION['type']);
} ?>