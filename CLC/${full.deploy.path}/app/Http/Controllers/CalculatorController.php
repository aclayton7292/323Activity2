<?php

namespace App\Http\Controllers;

use App\Models\CalculatorModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\Business\CalculatorServ;

class CalculatorController extends Controller
{
    public function index(Request $request){

       try{
            
           $this->validateForm($request);
        $num1 = $request->input("number1");
        $num2 = $request->input("number2");
        $func = $request->input("function");
        $num3 = 0;
        
        $num = new CalculatorModel($num1, $num2, $func, $num3);

        $serv = new CalculatorServ();
        $newNum = $serv->calculate($num); 
        $data = ['model' => $newNum];
        return view('CalculatorResultView')->with($data);
       }
       catch(ValidationException $e1){
           throw $e1;
       }
       catch(Exception $e2){
           //return view("systemException");
       }
       
        
       
    }
    private function validateForm(Request $request){
        $rules= ['number1' => 'Required' , 'number2' => 'Required' ];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
    
   
}
