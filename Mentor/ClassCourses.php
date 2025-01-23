<?php
//tea
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../src/data/conte_db.php";

require "../src/data/classcours.php";

$crudclasscour = new crudclasscours();
$Categories=$crudclasscour->get_classcours();






?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .sidebar {
      width: 250px;
      position: fixed;
      height: 100%;
      background-color: #007bff;
      padding: 20px 15px;
      overflow-y: auto;
      transition: all 0.3s ease-in-out;
    }

    .sidebar h4 {
      text-align: center;
      color: white;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: white;
      padding: 12px 15px;
      text-decoration: none;
      display: block;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 10px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #0056b3;
    }

    .container {
      margin-left: 260px;
      padding: 20px;
    }

    .table-container {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-status {
      width: 100px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .container {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center text-white">EduAdmin</h4>
    <a href="#"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="#" class="active"><i class="fas fa-book me-2"></i> Courses</a>
    <a href="#"><i class="fas fa-users me-2"></i> Students</a>
    <a href="#"><i class="fas fa-cogs me-2"></i> Settings</a>
  </div>

  <!-- Main Content -->
  <div class="container">
    <h2 class="mb-4">Class Courses</h2>

    <div class="table-container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Course Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($Categories as $data) :?>
          <tr>
            <td><?php echo $data->getid_classcours(); ?></td>
            <td><?php echo $data->getFullName(); ?></td>
            <td><?php echo $data->gettitre_cours(); ?></td>
            <td><span class="badge bg-success"><?php echo $data->gets_status(); ?></span></td>
            <td>
              <form action="../../src/modle/classcours.php" method="POST" >
                <input type="hidden" name="Status" value="<?php echo $data->gets_status(); ?>">
                <input type="hidden" name="id_classcours" value="<?php echo $data->getid_classcours(); ?>">
              
              <button class="btn btn-warning btn-status" name="submit">Deactivate</button>
              </form>
            </td>
          </tr>
          <?php endforeach ;?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.btn-status').forEach(button => {
      button.addEventListener('click', () => {
        const row = button.closest('tr');
        const statusBadge = row.querySelector('.badge');
        const isActive = statusBadge.classList.contains('bg-success');

        if (isActive) {
          statusBadge.classList.remove('bg-success');
          statusBadge.classList.add('bg-danger');
          statusBadge.textContent = 'not_active';
          button.textContent = 'Activate';
          button.classList.remove('btn-warning');
          button.classList.add('btn-success');
        } else {
          statusBadge.classList.remove('bg-danger');
          statusBadge.classList.add('bg-success');
          statusBadge.textContent = 'Active';
          button.textContent = 'Deactivate';
          button.classList.remove('btn-success');
          button.classList.add('btn-warning');
        }
      });
    });
  </script>
</body>
</html>
