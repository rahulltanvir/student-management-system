<div class="cointainer">
  <div class="row">
    <div class="col-md-4">
      <div class="card text-white bg-primary shadow p-3">
        <h5>Total Students</h5>
        <h2>120</h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-success shadow p-3">
        <h5>Active Students</h5>
        <h2>98</h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-danger shadow p-3">
        <h5>New Students</h5>
        <h2>22</h2>
      </div>
    </div>
  </div>
</div>

  <br>

  <!-- TABLE -->
  <div class="box">
    <h5>Student List</h5>

    <table class="table table-hover mt-3">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Class</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>Rahim</td>
          <td>10</td>
          <td><span class="badge bg-success">Active</span></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Kabir</td>
          <td>9</td>
          <td><span class="badge bg-success">Active</span></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Hasan</td>
          <td>8</td>
          <td><span class="badge bg-danger">Inactive</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <br>

  <!-- SMS + FORM -->
  <div class="row g-3">

    <div class="col-md-6">
      <div class="box">
        <h5>Send SMS</h5>
        <textarea class="form-control" rows="5"></textarea>
        <button class="btn btn-primary mt-2 w-100">Send SMS</button>
      </div>
    </div>

    <div class="col-md-6">
      <div class="box">
        <h5>Add Student</h5>

        <input class="form-control mb-2" placeholder="Name">
        <input class="form-control mb-2" placeholder="Class">
        <input class="form-control mb-2" placeholder="Phone">
        <textarea class="form-control mb-2" placeholder="Address"></textarea>

        <button class="btn btn-success w-100">Submit</button>
      </div>
    </div>

  </div>