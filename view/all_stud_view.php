  <?php
  


  $dis_all_data=$smsObj->dipalyStudent();
  
  
  ?>


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
          <th>Contract</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php while($dis_all_data_f=mysqli_fetch_assoc($dis_all_data)){ ?>
        <tr>
          <td><?php echo $dis_all_data_f['std_name'] ?></td>
          <td><?php echo $dis_all_data_f['std_roll'] ?></td>
          <td><?php echo $dis_all_data_f['s_class'] ?></td>
          <td><?php echo $dis_all_data_f['s_section'] ?></td>
          <td><?php echo $dis_all_data_f['s_session'] ?></td>
          <td><?php echo $dis_all_data_f['std_phone'] ?></td>
          <td><span class="badge bg-success"><?php echo $dis_all_data_f['std_status'] ?></span></td>
          <td>
            <a href="update_student.php?status=edit&id=<?php echo $dis_all_data_f['id'] ?>" class="btn btn-info">Edit</a>
            <a href="" class="btn btn-danger">Delete</a>
          </td>
          
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if(isset($_SESSION['success'])) { ?>

<script>
swal({
    title: "Good job!",
    text: "<?= $_SESSION['success']; ?>",
    icon: "success",
    button: "OK",
});
</script>

<?php unset($_SESSION['success']); } ?>