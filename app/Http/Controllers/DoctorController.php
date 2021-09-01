<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    //
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "name"     => "required",
            "email"    => "required|email",
           
            ]);

        if($validator->fails()) {
        return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }
        
        $result= DB::table('doctors')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address
        ]);
        if ($result)
            return response()->json( ["result"=> "added new doctors successfully"]);
        else
            return  response()->json( ["result"=> "error updating"]);
        
    }

    public function show($id=null)
    {
        //
        $data=DB::table('doctors')->get();
        $dataCount=DB::table('doctors')->count();
        return ['data'=>$data,"datacount"=>$dataCount];

    }

    public function edit(Request $req,$id)
    {
        
        $data=DB::table('doctors')->where('id',$id)->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address
        ]);
        if ($data)return ["result"=> "updated successfully"];
        else return ["result"=> "failed update"];
    }

    public function delete($id)
    {
    
        $result=DB::table('doctors')->where('id',$id)->delete();
       
        return ["result"=> "delted successfully"];
          
    }
}
