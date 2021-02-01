<?php

namespace App\Http\Controllers;

use App\Http\Services\Business\SecurityService;
use App\Http\Services\Utility\MyLogger2;
use App\Http\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;


class LoginController extends Controller
{
    
    
    
    public function index(Request $request){

        try{
            
           // $this->validateForm($request);
            
            
            $username = $request->input("username");
            $password = $request->input("password");
            
            $user = new UserModel(-1, $username, $password);          
            $service = new SecurityService();
            $status = $service->login($user);
            
            if($status)
            {
                $data = ['model' => $user];
                return view('loginPassed')->with($data);
            }
            else{              
                return view('loginFailed');
            }
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    public function showAllUsers(Request $request){
        try{

            $users = new SecurityService();
            $result = $users->getAllUsers();
            return view('showAllUsers')->with('result',$result);
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    public function logoutUser()
    {
        Session::flush();
        return redirect()->route('login5');
    }
    public function createUser(Request $request){
        try{
            //exit("It broke");
          
            //Validate Form Data
            //$this->validateForm($request);
            //pull form data to make user
           
            $username = $request->input('username');
            $password = $request->input('password');
            
           
            //create new user object
            $newUser = new UserModel(null,$username, $password);
            //pass the person object to the registeration service
            $makeUser = new SecurityService();
            //result will return the output of create method within the registeration service
            $result = $makeUser->create($newUser);
            if($result == true){
                //if result is true then take user to the register success view
                return view('login3');
            }
            else
                 return view('loginFailure')->with("result",$result);
        }
        catch(ValidationException $e1){            
            throw $e1;
        }
        catch(Exception $e2){
            exit("$e2");
            //return view("systemException");
        }
    }
    
    private function validateForm(Request $request){
        $rules= ['username' => 'Required | Between: 4,10 | Alpha', 'password' => 'Required |  Between: 4,10'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
   
}
