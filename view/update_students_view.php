<?php

if(isset($_GET['status'])){
  if($_GET['status']='edit'){
    $id =$_GET['id'];
    $student=$smsObj->getStudentById($id);
    
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
          <?php if(isset($st_add)){ echo $st_add; } ?>
          <label for="std_name">Name:</label>
          <input class="form-control mb-2" name="std_name" id="std_name" value="<?php echo $allStdData_f['std_name']; ?>" required>
          <label for="std_roll">Roll:</label>
          <input class="form-control mb-2" name="std_roll" id="std_roll" value="<?php echo $allStdData_f['std_roll']; ?>" required>
          <label for="std_class">Class:</label>
          <select name="std_class" id="std_class" class="form-control mb-2" required>
            <?php while ($allStdData_f) { ?>
              <option value="<?php echo $allStdData_f['s_id'] ?>"><?php echo $allStdData_f['s_class']; ?></option>
            <?php } ?>
          </select>
          <label for="section">Section:</label>
          <select name="std_section" id="section" class="form-control mb-2" required>
            <?php while ($allStdData_f) { ?>
              <option value="<?php echo $allStdData_f['id'] ?>"><?php echo $allStdData_f['s_section']; ?></option>
            <?php } ?>
          </select>
          <label for="session">Session:</label>
          <select name="std_session" id="session" class="form-control mb-2" required>
            <?php while ($allStdData_f) { ?>
              <option value="<?php echo  $allStdData_f['id'] ?>">$allStdData_f</option>
            <?php } ?>
          </select>
          <label for="phone">Phone Number:</label>
          <input type="text" name="std_phn" id="phone" class="form-control mb-2"  value="<?php echo $allStdData_f['s_section']; ?>">
          <label for="Status">Status:</label>
          <select name="std_status" id="section" class="form-control mb-2" required>
            <option value="<?php echo $allStdData_f['std_status']; ?>">Active</option>
            <option value="<?php echo $allStdData_f['std_status']; ?>">Inactive</option>
          </select>

          <button type="submit" class="btn btn-success w-100" name="submit">Submit</button>
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