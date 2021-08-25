<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginSignupController extends Controller
{
    
    private $success_status_code = 200;
    private $wrong_credentials_status_code = 401;
    
    public function userSignUp(Request $req){

       
        // ------------ [ User Signup ] -------------------

        //form field validation
        $validator = Validator::make($req->all(), [
            "name"     => "required",
            "email"    => "required|email",
            "password" => "required", 
            ]);

        if($validator->fails()) {
        return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        //if using same email to register again, registry fail
        $user_status =  User::where("email", $req->email)->first();

        if(!is_null($user_status)) {
           return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! email already registered"]);
        }

        //save the form data in the database
        $UserDetails= new User;
        $UserDetails->name=$req->name;
        $UserDetails->email=$req->email;
        $UserDetails->password=md5($req->password);
        $UserDetails->phone=$req->phone;
        $UserDetails->role=$req->role;
        $result= $UserDetails->save();
        if($result){
         // return [$UserDetails];
            return response()->json(["message" => "Registration completed successfully", "data" => $UserDetails]);
        }
       else{
        //    return "failed to save";
        return response()->json(["message" => "failed to register"]);
    }
    }
    
    // ------------ [ User Login ] -------------------
    public function userLogin(Request $request) {

        //form validation
        $validator = Validator::make($request->all(),
            [
                "email"   => "required|email",
                "password"=> "required"
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }


        // check if entered email exists in db
        $email_status = User::where("email", $request->email)->first();


        // if email exists then we will check password for the same email

        if(!is_null($email_status)) {
            $password_status = User::where("email", $request->email)->where("password", md5($request->password))->first();

            // if password is correct
            if(!is_null($password_status)) {
                $user = $this->userDetail($request->email);

                return response()->json(["status" => $this->success_status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
            }

            else {
                return response()->json(["status" => $this->wrong_credentials_status_code, "success" => false, "message" => "Unable to login. Incorrect Credentials."]);
            }
        }

        
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
        }
    }

    // ------------------ [ User Details ] ---------------------
    public function userDetail($email) {
        $user = array();
        if($email != "") {
            $user = User::where("email", $email)->first();
            return $user;
        }
    }
}
