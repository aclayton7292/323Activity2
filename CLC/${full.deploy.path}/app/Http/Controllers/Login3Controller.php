<?php

namespace App\Http\Controllers;

use App\Services\Business\SecurityService;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;


class Login3Controller extends Controller
{
    
    
    
    public function index(Request $request){
        try{
            
            $this->validateForm($request);
            
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
    
    private function validateForm(Request $request){
        $rules= ['username' => 'Required | Between: 4,10 | Alpha', 'password' => 'Required |        Between: 4,10'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
   
}
