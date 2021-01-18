<?php
namespace App\Http\Services\Business;

use App\Http\Models\UserModel;
use PDO;
use Illuminate\Support\Facades\Log;
use App\Http\Services\Data\SecurityDAO;

class SecurityService{
    
    public function login(UserModel $user){
        //gets rid of echo statements
        Log::info("Entering SecurityService.login()");       
        
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        
        //BEST practice: Do NOT create a database Connections in a DAO
        //(So you can support Atomic Database Transacations
        //Create Connection
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new SecurityDAO($db);
        $flag = $service->findByUser($user);
        
        //in PDO you "close" the database connection by setting the PDO object to null
        $db = null;
        
        //Return the finder results
        Log::info("Exit SecurityService.login() with " . $flag);
        return $flag;
        
    }
    
}