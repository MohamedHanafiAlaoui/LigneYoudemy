<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../class/user.php";




if (isset($_POST["submit"])) {
   
    $nameError = $emailError = $passwordError = "";
    $isValid = true;
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fullName = $_POST["fullName"];
    $id_role = $_POST["id_role"];
  
    $newUser = new User( null,null, null,$email , null, null);

    

    if (empty($fullName)) {
        $nameError = "Le nom est requis.";
        header("Location: /Mentor/sinup.php?msg=$nameError");
        $isValid = false;
        exit;
    }else {
        $fullName = trim($fullName);
        $fullName = htmlspecialchars($fullName);
        if (!preg_match("/^[a-zA-Z\s]+$/", $fullName)) {
            $nameError = "Le nom ne doit contenir que des lettres et des espaces.";
            header("Location: /Mentor/sinup.php?msg=$nameError");
            $isValid = false;
            exit;

        }
    }

  
    if (empty($email)) {
        $emailError = "L'email est requis.";
        $isValid = false;
        
    }else if($newUser->serchemail($email)){
        
        $emailError = "change email";
        header("Location: /Mentor/sinup.php?msge=$emailError");
        $isValid = false;
        exit;

        }else {
        $email = trim($email);
        $email = htmlspecialchars($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Veuillez entrer un email valide.";
            header("Location: /Mentor/sinup.php?msge=$emailError");
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
            header("Location: /Mentor/sinup.php?msgp=$passwordError ");
            $isValid = false;
            exit;
        } else if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
            $passwordError = "Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, et un chiffre.";
            header("Location: /Mentor/sinup.php?msgp=$passwordError ");

            $isValid = false;
        }
    }

    if ( !(1 < $id_role && $id_role <4)) {

        header("Location: /Mentor/page404.php");

    }


    
    if ($isValid) {
        try {
    
            $newUser = new User( null,$fullName, $password,  $email,  $id_role, "https://static.vecteezy.com/system/resources/thumbnails/002/387/693/small_2x/user-profile-icon-free-vector.jpg");
            $newUser->setPasswordHash($password);
            if ($newUser->newUser()) {
                echo "تمت إضافة المستخدم بنجاح!";
            }
        } catch (Exception $e) {
            echo " error: " . $e->getMessage();
        }
        


    }
}




