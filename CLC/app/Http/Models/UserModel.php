<?php 
namespace App\Http\Models;

//refactor and rename as CredintialModel for better practice
class UserModel implements \JsonSerializable{
    
    private $id;
    private $username;
    private $password;

    //BEST practice: Use a non-defualt constructor for Object models
    public function __construct($id, $username, $password){
        $this->id=$id;
        $this->username=$username;
        $this->password=$password;
    }
    
    public function jsonSerialize(){
        return get_object_vars($this);
    }
    
    //BEST practice: Just implement getter (read-only) accessors for Object Models
    public function getUsername(){
        return $this->username;
    }
    //BEST practice: Just implement getter (read-only) accessors for Object Models
    public function getPassword(){
        return $this->password;
    }
    public function getId(){
        return $this->id;
    }
    
    
    
}
?>