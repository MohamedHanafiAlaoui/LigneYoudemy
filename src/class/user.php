<?php
require "./conte_db.php";

class  User
{
  private  $id_user; 
  private $FullName ;
  private $Password ;
  private $Email ;
  private $id_role; 
  private $image_user;
  protected $conn;
  function __construct($id_user,$FullName,$Password,$Email,$id_role,$image_user){

    $this ->id_user = $id_user;
    $this ->FullName = $FullName;
    $this ->Email = $Email;
    $this ->id_role = $id_role;
    $this ->Password = $Password;

    $this ->image_user = $image_user;
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
            "INSERT INTO user (FullName, Password, Email, id_role, image_user) 
             VALUES (:FullName, :Password, :Email, :id_role, :image_user)"
        );
        $stmt-> bindParam(':FullName',$this->FullName) ;
        $stmt-> bindParam(':Password',$this->Password) ;
        $stmt-> bindParam(':Email',$this->Email) ;
        $stmt-> bindParam(':id_role',$this->id_role) ;
        $stmt-> bindParam(':image_user',$this->image_user) ;
        $stmt->execute();
        return true;
    } 
    catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        throw new Exception("An error occurred while saving the user: " . $e->getMessage());
    }


  }

  public static function findByEmail($email) {
    $conn=Conte_db::getConnection()->getConn();

    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result) {
  return   new User($result['id_user'], $result['FullName'], $result['Password'], $result['Email'], $result['id_role'],$result['image_user']);

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
        throw new Exception("Password mismatch");
    }

    return $user;
}


}


