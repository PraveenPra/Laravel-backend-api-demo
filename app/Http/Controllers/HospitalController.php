<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "name"     => "required",
            "email"    => "required|email",
           
            ]);

        if($validator->fails()) {
        return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }
        
        $result= DB::table('hospitals')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address
        ]);
        if ($result)
            return response()->json( ["result"=> "added new hospital successfully"]);
        else
            return  response()->json( ["result"=> "error updating"]);
        
    }

    public function show()
    {
        //
        $data=DB::table('hospitals')->get();
        $dataCount=DB::table('hospitals')->count();
        return ['data'=>$data,"datacount"=>$dataCount];

    }

    public function showid($id)
    {
        //
        $data=DB::table('hospitals')->find($id);
       
        return ['data'=>$data];

    }

    public function edit(Request $req,$id)
    {
       
        $data=DB::table('hospitals')->where('id',$id)->update([
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
    
        $result=DB::table('hospitals')->where('id',$id)->delete();
       
        return ["result"=> "failed to delete"];
          
    }
}
