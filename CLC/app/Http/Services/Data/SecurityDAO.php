<?php
namespace App\Http\Services\Data;

use \PDO;
use Illuminate\Support\Facades\Log;
use PDOException;
use App\Http\Models\UserModel;
use App\Http\Services\Utillity\DatabaseException;
use App\Http\Services\Utility\MyLogger2;

class SecurityDAO{
    //comment
    private $db;
    
    //BEST practice: Do not create Database Connections in a
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function findByUser(UserModel $user)
    {
        Log::info("Entering SecurityDAO.findByUser()");
        
        try
        {
            //Select username and password and see if this row exists
            $name = $user->getUsername();
            $pw = $user->getPassword();
            
            $stmt = $this->db->prepare("SELECT ID, USERNAME, PASSWORD FROM users
                                       WHERE USERNAME = :username AND PASSWORD = :password");
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':password', $pw);
            $stmt->execute();
            
            //See if user existed and return true if found else return false if not found
            //Bad practice: this is a business rules in our DAO
            if ($stmt->rowCount() == 1){
                Log::info("Exit SecurityDAO.findByUser() with true");
                return true;
                
            }
            else{
                Log::info("Exit SecurityDAO.findByUser() with false");
                return false;
            }
            
        }
        catch (PDOException $e)
        {
            //BEST practice: catch all exceptions (do not swallow exceptions),
            //log the exception, do not throw technology specific exceptions, and throw a cusom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }
    public function makeUser(UserModel $user){
         $username = $user->getUsername();
         $password = $user->getPassword();
      
        
       
            //add user
            $this->db = mysqli_connect("jhdjjtqo9w5bzq2t.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "dg31i4996aumjsx4", "votlj20l2eaf1h6n", "keolpuetjk8bnvra");
            $sql_statement_user = "INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`) VALUES (NULL, '$username', '$password')";
            if (mysqli_query($this->db, $sql_statement_user)) {
                return true;
            }
            else 
                return false;
        
    }
    public function findByUserId($id)
    {
       MyLogger2::info("Entering SecurityDAO.findByUserId()");
        
        try
        {
            $stmt = $this->db->prepare("SELECT ID, USERNAME, PASSWORD FROM users
                                       WHERE ID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //See if user existed and return true if found else return false if not found
            //Bad practice: this is a business rules in our DAO
            if ($stmt->rowCount() == 1){
                MyLogger2::info("Exit SecurityDAO.findByUserId() with true");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $user = new UserModel($row['ID'], $row['USERNAME'], $row['PASSWORD']);                  
                    return $user;
                }
                
            }
            else{
                MyLogger2::info("Exit SecurityDAO.findByUserId() with null");
                return null;
            }
            
        }
        catch (PDOException $e)
        {
            //BEST practice: catch all exceptions (do not swallow exceptions),
            //log the exception, do not throw technology specific exceptions, and throw a cusom exception
            MyLogger2::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }
    public function findAllUsers()
    {
        MyLogger2::info("Entering SecurityDAO.findAllUsers()");
        
        try
        {
            $stmt = $this->db->prepare("SELECT ID, USERNAME, PASSWORD FROM users");
            $stmt->execute();
            
            //See if user existed and return true if found else return false if not found
            //Bad practice: this is a business rules in our DAO
            if ($stmt->rowCount() == 0){
                MyLogger2::info("Exit SecurityDAO.findByUserId() with null");
                return null;
            }
            else{
                MyLogger2::info("Exit SecurityDAO.findAllUsers with users");
                $index = 0;
                $users = array();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $user = new UserModel($row['ID'], $row['USERNAME'], $row['PASSWORD']);
                    $users[$index++] = $user;
                }
                return $users;
               
            }
            
        }
        catch (PDOException $e)
        {
            //BEST practice: catch all exceptions (do not swallow exceptions),
            //log the exception, do not throw technology specific exceptions, and throw a cusom exception
            MyLogger2::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception " . $e->getMessage(), 0, $e);
        }
    }
    
}