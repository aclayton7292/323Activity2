<?php

namespace App\Http\Controllers;

use App\Services\Business\SecurityService;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Exception;

class Login2Controller extends Controller
{
    public function index(Request $request){
        try{
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
        catch(Exception $e){
            
        }
    }
    
   
}
