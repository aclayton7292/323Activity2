<?php
namespace App\Http\Services\Data;

use \PDO;
use Illuminate\Support\Facades\Log;
use PDOException;
use App\Http\Models\UserModel;
use App\Http\Services\Utillity\DatabaseException;

class SecurityDAO{
    
    private $db = NULL;
    
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
    
}