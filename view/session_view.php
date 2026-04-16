<?php 
    if(isset($_POST['add_session_btn'])){
        $sessionData=$smsObj->addSession($_POST);
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
                                <a class="btn btn-info" href="">Edit</a>
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