<?php

namespace App\Http\Controllers;

use App\Http\Services\Business\SecurityService;
use App\Http\Services\Utility\MyLogger2;
use App\Http\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;


class Login5Controller extends Controller
{
    
    
    
    public function index(Request $request){
        
        MyLogger2::info("Entering Login5Controller.index()");
        
        try{
            
            $this->validateForm($request);
            
            
            $username = $request->input("username");
            $password = $request->input("password");
            
            $user = new UserModel(-1, $username, $password);
            
            MyLogger2::info("User: ", array("username" => $username, "password" =>$password));
            
            $service = new SecurityService();
            $status = $service->login($user);
            
            if($status)
            {
                MyLogger2::info("Exit Login5Controller.index() with login passed");
                $data = ['model' => $user];
                return view('loginPassed')->with($data);
            }
            else{
                MyLogger2::info("Exi Login5Controller.index() with login failed");
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
    
    private function validateForm(Request $request){
        $rules= ['username' => 'Required | Between: 4,10 | Alpha', 'password' => 'Required |  Between: 4,10'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
   
}
