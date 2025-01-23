<?php
//admin
require_once "../src/data/conte_db.php";

require "../src/data/tags.php";

$tag = new crudtags();
$tags=$tag->get_tags();


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Tags</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .sidebar {
      width: 250px;
      position: fixed;
      height: 100%;
      background-color: #007bff;
      padding-top: 20px;
    }

    .sidebar a {
      color: white;
      padding: 10px;
      text-decoration: none;
      display: block;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .sidebar a:hover, .sidebar a.active {
      background-color: #0056b3;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .sidebar a {
        text-align: center;
        margin: 5px 0;
      }

      .content {
        margin-left: 0;
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
  <div class="content">
    <div class="form-container">
      <h2>Manage Tags</h2>
      <form action="../src/modle/ajoutetag.php" method="POST">
        <!-- Tag Name -->
        <div id="tags-container">
          <div class="tagNames">
            <div class="form-group">
              <label for="tagName">Tag Name</label>
              <input type="text" class="form-control" id="tagName" name="Tags[0][Tag]" placeholder="Enter Tag Name" required>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit" class="btn btn-primary mt-3">Add Tag</button>
        <button type="button" id="add-Tag" class="btn btn-primary mt-3">Add Another Tag</button>
      </form>

      <!-- Tag List -->
      <h3 class="mt-5">Existing Tags</h3>
      <ul class="list-group">
        <?php foreach($tags as $tag):  ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?php echo  $tag->getname_tag() ?>
          <div>
          <button class="btn btn-danger btn-sm"> <a href="../src/modle/DELETEtags.php?id= <?php echo  $tag->getid_tag() ?>" style="color:#fff;"> <i class="fas fa-trash"></i></a></button>
          <button class="btn btn-warning btn-sm"><a href="?id= <?php echo  $tag->getid_tag() ?>" style="color:#fff;"> <i class="fas fa-edit"></i> </a></button>

          </div>

        </li>
        <?php endforeach ?>

      </ul>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById('add-Tag').addEventListener('click', function () {
      const container = document.getElementById('tags-container');
      const tagNamesGroups = container.getElementsByClassName('tagNames');
      const index = tagNamesGroups.length;

      const newGroup = tagNamesGroups[0].cloneNode(true);

      const inputs = newGroup.querySelectorAll('input, select, textarea');
      inputs.forEach(input => {
        const name = input.name.replace(/\[\d+\]/, `[${index}]`);
        input.name = name;

        if (input.id) {
          input.id = input.id.replace(/_\d+$/, `_${index}`);
        }
        input.value = ''; 
      });

      container.appendChild(newGroup);
    });
  </script>
</body>
</html>
