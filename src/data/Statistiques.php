<?php




class Statistiques
{
    private $conn;
    public function __construct()
    {
     $this ->conn=Conte_db::getConnection()->getConn();
 
    }


public function  StatistiquesUSEr()  {
    $query = $this->conn->prepare("SELECT count(*) AS total FROM user WHERE id_role =3;");

    $query->execute();
    $result = $query->fetch();
    return $result['total'];
    }

    public function  Statistiquescours()  {
        $query = $this->conn->prepare("SELECT count(*) AS total FROM cours ");
    
        $query->execute();
        $result = $query->fetch();
        return $result['total'];
        }

        public function  Statistiquestop()  {
            $query = $this->conn->prepare("SELECT 
                                                user.FullName, 
                                                COUNT(cours.id_cours) AS total 
                                            FROM 
                                                cours 
                                            JOIN 
                                                user 
                                            ON 
                                                cours.id_user = user.id_user 
                                            GROUP BY 
                                                cours.id_user, user.FullName 
                                            LIMIT 3;
                                            ");
        
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            }



}

