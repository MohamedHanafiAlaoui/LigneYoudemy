<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";
require_once "../data/user.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $s_status  ;

    if($_GET['status'] == "active")
    {
        $s_status ="disactive";
    }else {
        $s_status ="active";

    }
    if (User::toggleStatus($id, $s_status)) {
        header("Location: /Mentor/Teacher.php");
      
    }

    
}

