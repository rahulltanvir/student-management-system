
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Management Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body class="dashbody">

  <div class="sidebar">
    <div>
      <div class="logo">SMS Dashboard</div>

      <ul class="menu">
        <li><a href="#" class="active">Dashboard</a></li>
        <li><a href="#">Class</a></li>
        <li><a href="#">Section</a></li>
        <li><a href="#">Session</a></li>
        <li><a href="#">Add Student</a></li>
        <li><a href="#">Student List</a></li>
        
      </ul>
    </div>
<div class="menu-item">
  <a class="menu-link" href="#" onclick="toggleMenu(event)">
    <span class="menu-icon"><i class="fa-solid fa-layer-group"></i></span>
    Admin Role
    <span class="menu-arrow"><i class="fa-solid fa-angle-down"></i></span>
  </a>

  <div class="submenu">
    <a href="add_category.php">Registration</a>
  </div>
</div>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <div class="main-content">
    <div class="topbar">
      <h1>Student Management Dashboard</h1>
      <div class="profile">Welcome, Admin</div>
    </div>

    <div class="cards">
      <div class="card">
        <h3>Total Students</h3>
        <h2>1,250</h2>
      </div>

      <div class="card">
        <h3>Total Teachers</h3>
        <h2>85</h2>
      </div>

      <div class="card">
        <h3>Total Courses</h3>
        <h2>35</h2>
      </div>

      <div class="card">
        <h3>Pending Fees</h3>
        <h2>120</h2>
      </div>
    </div>

    <div class="table-box">
      <h2>Recent Students</h2>

      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Class</th>
          <th>Status</th>
        </tr>

        <tr>
          <td>101</td>
          <td>Rahim Ahmed</td>
          <td>10</td>
          <td><span class="status active-status">Active</span></td>
        </tr>

        <tr>
          <td>102</td>
          <td>Karim Hasan</td>
          <td>9</td>
          <td><span class="status active-status">Active</span></td>
        </tr>

        <tr>
          <td>103</td>
          <td>Nusrat Jahan</td>
          <td>8</td>
          <td><span class="status inactive-status">Inactive</span></td>
        </tr>

        <tr>
          <td>104</td>
          <td>Sakib Khan</td>
          <td>7</td>
          <td><span class="status active-status">Active</span></td>
        </tr>
      </table>
    </div>
  </div>



<script>
  function toggleMenu(event) {
    event.preventDefault();

    let submenu = event.currentTarget.nextElementSibling;
    submenu.classList.toggle("show");
  }
</script>
</body>
</html>
