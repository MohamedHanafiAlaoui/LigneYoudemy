<?php


class  User
{
  private  $id_user; 
  private $FullName ;
  private $Password ;
  private $Email ;
  private $id_role; 
  private $image_user;
  private $s_status;
  private $bane;
  protected $conn;
  function __construct($id_user,$FullName,$Password,$Email,$id_role,$image_user,$s_status="active",$bane="bane"){

    $this ->id_user = $id_user;
    $this ->FullName = $FullName;
    $this ->Email = $Email;
    $this ->id_role = $id_role;
    $this ->Password = $Password;

    $this ->image_user = $image_user;
    $this ->s_status = $s_status;
    $this ->bane = $bane;
  }

  public function __tostring()
  {
    return "$this->FullName";
  }


  public function getid()
  {
    return $this->id_user;
  }

  public function getFullName()
  {

    return $this->FullName;
    
  }

  public function getEmail()
  {

    return $this->Email;
    
  }

  public function getimage_user()
  {

    return $this->image_user;
    
  }

  public function getid_role()
  {
    return $this -> id_role;
  }

  public function gets_status()
  {
    return $this -> s_status;
  }

  public function getbane()
  {
    return $this -> bane;
  }

  public function setpasswordHash($Password)
  {
    $this -> Password = password_hash($Password,PASSWORD_DEFAULT);

  }

  public function newuser()
  {
    $conn=Conte_db::getConnection()->getConn();
    try 
    {

        $stmt = $conn->prepare(
            "INSERT INTO user (FullName, Password, Email, id_role, image_user,s_status) 
             VALUES (:FullName, :Password, :Email, :id_role, :image_user,:s_status)"
        );
        $stmt-> bindParam(':FullName',$this->FullName) ;
        $stmt-> bindParam(':Password',$this->Password) ;
        $stmt-> bindParam(':Email',$this->Email) ;
        $stmt-> bindParam(':id_role',$this->id_role) ;
        $stmt-> bindParam(':image_user',$this->image_user) ;
        $stmt-> bindParam(':s_status',$this->s_status) ;
        $stmt->execute();
        return true;
    } 
    catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        throw new Exception("An error occurred while saving the user: " . $e->getMessage());
    }


  }
  public static function serchemail($email) {

    $conn=Conte_db::getConnection()->getConn();

    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
    
      return 0;
    }else
    {
     
      return 1;
    }


  }






  public static function findByEmail($email) {
    $conn=Conte_db::getConnection()->getConn();

    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result) {
  return   new User($result['id_user'], $result['FullName'], $result['Password'], $result['Email'], $result['id_role'],$result['image_user'],$result['s_status'],$result['bane']);

    }

    return null;
}
public static function signin($email, $password)
{
    $user = self::findByEmail($email);

    if (!$user) {
        throw new Exception("User not found");
        
    }

    if (!password_verify($password, $user->Password)) {
      throw new Exception("");
        
    }

    return $user;
}






public static function userTeacher() {
  try {
      $conn = Conte_db::getConnection()->getConn();

      $stmt = $conn->prepare("SELECT id_user, FullName, Email, s_status FROM user WHERE id_role = 2;");
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $teachers = [];
      foreach ($data as $result) {
          $teachers[] = new User($result['id_user'], $result['FullName'], null, $result['Email'], null, null, $result['s_status'], null);
      }
      return $teachers;
  } catch (PDOException $e) {
      error_log("Error fetching teachers: " . $e->getMessage());
      return [];
  }
}





public static function toggleStatus($id, $s_status) {
  $conn = Conte_db::getConnection()->getConn();

  try 
  {
     $stmt = $conn->prepare("UPDATE user SET s_status = :s_status WHERE id_user = :id");
  $stmt->bindParam(':s_status', $s_status);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return true;
  } 
  catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    throw new Exception("An error occurred while adding the course: " . $e->getMessage());
  }
}




public static function userEtudiant() {
  try {
      $conn = Conte_db::getConnection()->getConn();

      $stmt = $conn->prepare("SELECT id_user, FullName, Email, bane FROM user WHERE id_role = 3;");
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $teachers = [];
      foreach ($data as $result) {
          $teachers[] = new User($result['id_user'], $result['FullName'], null, $result['Email'], null, null,null,  $result['bane']);
      }
      return $teachers;
  } catch (PDOException $e) {
      error_log("Error fetching teachers: " . $e->getMessage());
      return [];
  }
}


public static function togglebane($id, $bane) {
  $conn = Conte_db::getConnection()->getConn();

  try 
  {
     $stmt = $conn->prepare("UPDATE user SET bane = :bane WHERE id_user = :id");
  $stmt->bindParam(':bane', $bane);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return true;
  } 
  catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    throw new Exception("An error occurred while adding the course: " . $e->getMessage());
  }
}


}


