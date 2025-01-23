<?php

//tea
require_once "../src/data/conte_db.php";

require "../src/data/cours.php";
require "../src/data/tags.php";

$Categorie = new curdcours();
$Categories=$Categorie->get_cours('1');



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      overflow-x: hidden; /* Prevent horizontal scroll */
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #007bff; /* Sidebar Color */
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
      background: #0056b3; /* Darker Shade for Active/Hover State */
      color: #fff;
    }

    .sidebar .brand-logo {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #fff;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
      transition: margin-left 0.3s ease-in-out;
    }

    .main-content .navbar {
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card {
      border: none;
      border-radius: 10px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding-top: 20px;
      }

      .sidebar a {
        text-align: center;
        padding: 15px;
      }

      .main-content {
        margin-left: 0;
        padding: 15px;
      }

      .navbar {
        padding: 10px;
      }

      .card {
        padding: 20px;
      }
    }

    @media (max-width: 576px) {
      .sidebar a {
        font-size: 14px;
      }
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <h3 class="navbar-brand">Courses</h3>
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

    <!-- Main Content Area -->
    <div class="container py-4">
      <!-- Add New Course Button -->
      <!-- <div class="mb-3">
        <a href="./ajoutercours.php" class="btn btn-success"><i class="fas fa-plus me-2"></i> Add New Course</a>
      </div> -->

      <!-- Courses Table -->
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card p-4 shadow-sm">
            <h5 class="mb-3">Course List</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Course ID</th>
                  <th>Course Name</th>
                  <th>Students</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($Categories as $Categorie):?>
                <tr>
                  <td><?php echo $Categorie->getid_cours(); ?></td>
                  <td><?php echo $Categorie->getTitreCours(); ?></td>
                  <td><?php echo $Categorie->gets_status(); ?></td>
                  <td>
                    <a href="edit-course.php/?id=<?php echo $Categorie->getid_cours(); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="../../src/modle/DELETEcours.php/?id=<?php echo $Categorie->getid_cours(); ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                  </td>
                 
                </tr>
                <?php endforeach ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
