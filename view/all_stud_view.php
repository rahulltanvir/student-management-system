  <?php
  $dis_all_data=$smsObj->dipalyStudent();
  if(isset($_GET['status']) && $_GET['status']=='delete'){
    $id=$_GET['id'];
    $deleStudentData=$smsObj->deleteStudent($id);
    if($deleStudentData==="Deleted Successfully"){
      $_SESSION['success']="Section Deleted Successfully!";
      $_SESSION['type']="delete";
    }else{
      $_SESSION['success']=$deleStudentData;
      $_SESSION['error']='error';
    }
  }
  
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
            <a
                                        class="btn btn-danger"
                                        href="?status=delete&id=<?php echo $dis_all_data_f['id'] ?>"
                                        onclick="return confirmDelete(event, this.href)">
                                        Delete
                                    </a>
          </td>
          
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php include_once("include/sweet_alart.php"); ?>