<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";
require_once "../data/user.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $s_status  ;

    if($_GET['status'] == "no")
    {
        $s_status ="oui";
    }else {
        $s_status ="no";

    }
    if (User::togglebane($id, $s_status)) {
        header("Location: /Mentor/Etudiant.php");
      
    }

    
}

