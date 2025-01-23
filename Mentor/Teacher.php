<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//tea
require_once "../src/data/conte_db.php";
require "../src/data/user.php";

// $Teacher =User::
$Teachers = User::userTeacher(); // Récupération des enseignants

?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teachers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      overflow-x: hidden;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #007bff;
      padding-top: 50px;
      transition: all 0.3s ease-in-out;
    }

    .sidebar a {
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      color: #fff;
      border-radius: 5px;
      margin: 10px 0;
      font-size: 16px;
    }

    .sidebar a.active, .sidebar a:hover {
      background: #0056b3;
      color: #fff;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
    }

    .card {
      border: none;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center text-white">EduAdmin</h4>
    <a href="./Dashboardadmin.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="./coursdsadmin.php"><i class="fas fa-book me-2"></i> Courses</a>
    <a href="./Categoriesadmin.php"><i class="fas fa-layer-group me-2"></i> Categories</a>
    <a href="./Tag.php"><i class="fas fa-tags me-2"></i> Tags</a>
    <a href="./Etudiant.php"><i class="fas fa-users me-2"></i> Students</a>
    <a href="./Teacher.php" class="active"><i class="fas fa-chalkboard-teacher me-2"></i> Teachers</a>
    <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <h3 class="navbar-brand">Teachers</h3>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item me-3">
            <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Profile</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container py-4">
      <!-- Teachers Table -->
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card p-4 shadow-sm">
            <h5 class="mb-3">Teacher List</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Teacher ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($Teachers as $Teacher): ?>
                <tr>
                  <td><?php echo $Teacher->getid(); ?></td>
                  <td><?php echo $Teacher->getFullName(); ?></td>
                  <td><?php echo $Teacher->getEmail(); ?></td>
                  <td>
                  <span class="badge bg-success"><?php echo $Teacher->gets_status(); ?></span>
                  </td>
                  <td>
                    <a href="../../src/modle/edit-teacher.php/?id=<?php echo $Teacher->getid(); ?>&status=<?php echo $Teacher->gets_status(); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
