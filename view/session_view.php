<?php 
    // if(isset($_POST['add_session_btn'])){
    //     $sessionData=$smsObj->addSession($_POST);
    // }
    if (isset($_POST['Add_section_data'])) {
    $sessionData = $smsObj->addSession($_POST);

    if ( $sessionData === "success") {
        $_SESSION['success'] = "Class Added Successfully!";
        header("Location:session.php");
        exit();
    }
}
$sessiondata=$smsObj->sessionDisplay();



?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="box">
                <h5>Add Session</h5>
                <?php if(isset( $sessionData)){ echo  $sessionData; } ?>
                <form action="" method="post">
                    <input type="" class="form-control mb-2" name="add_session" placeholder="add session" required>
                    <button type="submit" name="add_session_btn" class="btn btn-success w-100">Submit</button>
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
                <h5>Session List</h5>

                <table class="table table-hover mt-3  w-100 text-center">
                    <thead class="table-dark ">
                        <tr>
                            <th class="col-md-2">ID</th>
                            <th class="col-md-7">Session</th>
                            <th class="col-md-3">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php while($sessiondata_f=mysqli_fetch_assoc($sessiondata)){ ?>
                        <tr>
                            <td><?php echo $sessiondata_f['id'] ;?></td>
                            <td><?php echo $sessiondata_f['s_session'] ;?></td>
                            <td>
                                <a class="btn btn-info" href="up_session.php?status=edit&id=<?php echo $sessiondata_f['id'] ;?>">Edit</a>
                                <a class="btn btn-danger" href="">Delete</a>
                            </td>

                        </tr>
                        <?php }?>
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
        function confirmDelete(event, url){
    event.preventDefault(); // link থামায়

    swal({
        title: "Are you sure?",
        text: "You want to delete this section!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.href = url; // delete run
        }
    });}
    </script>

<?php
    unset($_SESSION['success']);
    unset($_SESSION['type']);
} ?>