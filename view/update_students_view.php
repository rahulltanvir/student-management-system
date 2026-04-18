<?php
if (isset($_GET['status'])) {
  if ($_GET['status'] = 'edit') {
    $id = $_GET['id'];
    $student = $smsObj->getStudentById($id);

    $allClass = $smsObj->displayClassData();
    $allSection = $smsObj->displaySection();
    $allSession = $smsObj->sessionDisplay();
  }
}
if (isset($_POST['submit'])) {

    $update = $smsObj->updateStudentData($_POST);

    if ($update === "Updated Successfully") {
        $_SESSION['success'] = "Student Updated Successfully!";
        header("Location: all_student_summary.php");
        exit();
    }
}
?>


<div class="container">
  <div class="row">
    <div class="col-md-2">
    </div>
    <!-- main -->
    <div class="col-md-8">
      <div class="box">
        <form action="" method="post">
          <h5>Add Student</h5>
          <?php if (isset($st_add)) {
            echo $st_add;
          } ?>
          <label for="std_name">Name:</label>
          <input class="form-control mb-2" name="std_name" id="up_std_name" value="<?php echo $student['std_name']; ?>" required>
          <label for="std_roll">Roll:</label>
          <input class="form-control mb-2" name="std_roll" id="up_std_roll" value="<?php echo $student['std_roll']; ?>" required>

          <label for="std_class">Class:</label>
          <select name="up_std_class" class="form-control mb-2">
            <?php while ($clasData = mysqli_fetch_assoc($allClass)) { ?>
              <option value="<?php echo $clasData['s_id']; ?>"
                <?php if ($clasData['s_id'] == $student['std_class']) echo 'selected'; ?>>
                <?php echo $clasData['s_class']; ?>
              </option>

            <?php } ?>

          </select>

          <label for="section">Section:</label>
          <select name="up_std_section" class="form-control mb-2">

            <?php while ($secData = mysqli_fetch_assoc($allSection)) { ?>

              <option value="<?php echo $secData['id']; ?>"
                <?php if ($secData['id'] == $student['std_section']) echo 'selected'; ?>>
                <?php echo $secData['s_section']; ?>
              </option>

            <?php } ?>

          </select>


          <label for="session">Session:</label>
          <select name="up_std_session" class="form-control mb-2">

            <?php while ($sessionData = mysqli_fetch_assoc($allSession)) { ?>

              <option value="<?php echo $sessionData['id']; ?>"
                <?php if ($sessionData['id'] == $student['std_session']) echo 'selected'; ?>>
                <?php echo $sessionData['s_session']; ?>
              </option>

            <?php } ?>

          </select>

          <label for="phone">Phone Number:</label>
          <input type="text" name="up_std_phn" id="phone" class="form-control mb-2" value="<?php echo $student['std_phone']; ?>">

          <label for="Status">Status:</label>
          <select name="up_std_status" class="form-control mb-2">

            <option value="Active" <?php if ($student['std_status'] == 'Active') echo 'selected'; ?>>
              Active
            </option>

            <option value="Inactive" <?php if ($student['std_status'] == 'Inactive') echo 'selected'; ?>>
              Inactive
            </option>

          </select>
          <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">

          <button type="Up_submit" class="btn btn-success w-100" name="submit">Submit</button>
        </form>
      </div>
    </div>
    <!-- main -->
    <div class="col-md-2">
    </div>
  </div>
  <br>
  <!-- <div class="container">
    <div class="row">
      <div class="box">
        <h5>Student List</h5>

        <table class="table table-hover mt-3">
          <thead class="table-dark">
            <tr>
              <th>Name</th>
              <th>Roll</th>
              <th>Class</th>
              <th>Section</th>
              <th>Session</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>Rahim</td>
              <td>10</td>
              <td>10</td>
              <td>10</td>
              <td>10</td>
              <td>10</td>
              <td>10</td>
              <td>
                <a href="">Edit</a>
                <a href="">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> -->
</div>
<?php if (isset($_SESSION['success'])) { ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
swal({
    title: "Good job!",
    text: "<?= $_SESSION['success']; ?>",
    icon: "success",
    button: "OK",
}).then(() => {
    window.location = "all_student_summary.php";
});
</script>

<?php unset($_SESSION['success']); } ?>
