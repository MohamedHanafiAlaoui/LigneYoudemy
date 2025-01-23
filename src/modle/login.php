<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../data/conte_db.php";

require "../data/user.php";






if (isset($_POST["submit"])) {
   
    $nameError = $emailError = $passwordError = "";
    $isValid = true;
    $email = $_POST["email"];
    $password = $_POST["password"];
    $newUser = new User( null,null, null,$email , null, null);

    

    if (empty($email)) {
        $emailError = "L'email est requis.";
        $isValid = false;
        
    }else if(!($newUser->serchemail($email))){
        
        $emailError = "no email";
        header("Location: /Mentor/login.php?msge=$emailError");
        $isValid = false;
        exit;

        }else {
        $email = trim($email);
        $email = htmlspecialchars($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Veuillez entrer un email valide.";
            header("Location: /Mentor/login.php?msge=$emailError");
            $isValid = false;
            exit;
        }
    }



    if (empty($password)) {
        $passwordError = "Le mot de passe est requis.";
        $isValid = false;
    } else {
        if (strlen($password) < 8) {
            $passwordError = "Le mot de passe doit contenir au moins 8 caractères.";
            header("Location: /Mentor/login.php?msgp=$passwordError ");
            $isValid = false;
            exit;
        } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            $passwordError = "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, et un chiffre.";
            header("Location: /Mentor/login.php?msgp=$passwordError ");

            $isValid = false;
            exit;
        }
    }




    
    if ($isValid) {
        try {
            $user = User::signin($email,  $password);

            echo "Welcome, " . $user->getFullName();

            session_start();
            $_SESSION['user_id'] = $user->getid();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_role'] =$user->getid_role();
            $_SESSION['FullName'] = $user->getFullName() ;
            $_SESSION['s_status'] = $user->gets_status() ;
            $_SESSION['bane'] = $user->getbane() ;

            if ($_SESSION['user_role'] == 1) {

            header("Location: /Mentor/Dashboardadmin.php");

                
            } else if ($_SESSION['user_role'] == 2) {
                
            header("Location: /Mentor/Dashboardtea.php");

            } else {
                header("Location: /Mentor/index.php");
            }
            


        } catch (Exception $e) {
            $passwordError = "not corecte.";

            echo "Error: ". $e->getMessage();
            header("Location: /Mentor/login.php?msgp=$passwordError ");

        }
    }
}




