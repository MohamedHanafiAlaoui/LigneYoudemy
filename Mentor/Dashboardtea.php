<?php
 
session_start();

// if (($_SESSION['user_id']==2 )&&($_SESSION['s_status']=="active" ) ) {
  
// }else {
//   header("Location: /Mentor/login.php");
// }
   




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduAdmin Dashboard</title>
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
      background-color: #007bff; /* New Color */
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

    .chart-container {
      position: relative;
      height: 400px;
      width: 100%;
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
    <a href="Dashboard.php" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="./coursds.php"><i class="fas fa-book me-2"></i> Courses</a>


  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <h3 class="navbar-brand">Dashboard</h3>
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
      <!-- Cards -->
      <div class="row mb-4">
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5>Total Students</h5>
            <h2>1,245</h2>
            <i class="fas fa-users fa-3x text-primary"></i>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5>Active Courses</h5>
            <h2>85</h2>
            <i class="fas fa-book fa-3x text-success"></i>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5>Revenue</h5>
            <h2>$45,320</h2>
            <i class="fas fa-dollar-sign fa-3x text-warning"></i>
          </div>
        </div>
      </div>

      <!-- Chart -->


      <!-- Data Table -->

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script>
    // Chart.js Configuration
    const ctx = document.getElementById('studentProgress').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Math', 'Science', 'History', 'Art'],
        datasets: [{
          label: 'Student Progress',
          data: [85, 72, 90, 78],
          backgroundColor: ['#007bff', '#28a745', '#ffc107', '#6c757d']
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: { beginAtZero: true },
          y: { beginAtZero: true }
        }
      }
    });

    // DataTable Initialization
    $(document).ready(function () {
      $('#courseTable').DataTable();
    });
  </script>
</body>
</html>
