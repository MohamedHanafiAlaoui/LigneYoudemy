<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../src/data/conte_db.php";

require "../src/data/Categories.php";
require "../src/data/tags.php";

session_start();

if (($_SESSION['user_role']==2 )&&($_SESSION['s_status']=="active" ) ) {
  
}else {
  header("Location: /Mentor/login.php");
}

$Categorie = new crudCategories();
$Categories=$Categorie->get_Categories();

$tag = new crudtags();
$tags=$tag->get_tags();


?>

<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin-top: 0;
    }

    .container {
      max-width: 800px;
      margin-left: 270px; /* To make space for the sidebar */
    }

    .form-container {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
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
  <div class="container">
    <div class="form-container">
      <h2>Add New Course</h2>
      <form action="../src/modle/ajoutercours.php" method="POST" enctype="multipart/form-data">
        <!-- Course Title -->
        <div class="form-group">
          <label for="courseTitle">Course Title</label>
          <input type="text" class="form-control" id="courseTitle" name="titre_cours" placeholder="Enter Course Title" required>
        </div>

        <!-- Course Content -->
        <div class="form-group">
          <label for="courseContent">Content</label>
          <textarea class="form-control" id="courseContent" name="contenu" rows="4" placeholder="Enter Course Content" required></textarea>
        </div>

        <!-- Description -->
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Course Description" required></textarea>
        </div>

        <!-- Associated User ID -->
        <div class="form-group">
          <!-- <label for="userID">User ID</label> -->
          <input type="hidden" class="form-control" id="userID" name="id_user" value="<?php echo $_SESSION['user_id']; ?>" placeholder="Enter User ID" required>
        </div>

        <!-- Status -->
        <div class="form-group">
          <label for="status">Status</label>
          <select class="form-control" id="status" name="s_status" required>
            <option value="active">Active</option>
            <option value="not_active">Inactive</option>
          </select>
        </div>

        <!-- Category -->
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" id="category" name="id_categories" required>

          <?php foreach($Categories as $Cate) :?>
            <option value="<?php echo $Cate->getid_categories();?>"><?php echo $Cate->getnamecategories();?></option>

          <?php endforeach ;?>

          </select>
        </div>

        <!-- Date -->
        <!-- <div class="form-group">
          <label for="date">Date</label>
          <input type="date" class="form-control" id="date" name="d_date" required>
        </div> -->

        <!-- Image -->
        <div class="form-group">
          <label for="image">Image</label>
          <input type="text" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Tags -->
        <div class="form-group">
          <label for="tags">Tags</label>
          <div id="tags">
            <?php foreach($tags as $tag) : ?>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tags[]" id="tagEducation" value="<?php echo $tag->getid_tag(); ?>">
              <label class="form-check-label" value="<?php echo $tag->getid_tag(); ?>" for="<?php echo $tag->getname_tag(); ?>"> <?php echo $tag->getname_tag(); ?></label>
            </div>
           <?php endforeach; ?>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit" class="btn btn-primary mt-3">Add Course</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
