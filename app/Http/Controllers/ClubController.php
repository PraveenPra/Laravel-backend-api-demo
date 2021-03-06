<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
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
        
        $result= DB::table('clubs')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address
        ]);
        if ($result)
            return response()->json( ["result"=> "added new clubs successfully"]);
        else
            return  response()->json( ["result"=> "error updating"]);
        
    }

    public function show()
    {
        //
        $data=DB::table('clubs')->get();
        $dataCount=DB::table('clubs')->count();
        return ['data'=>$data,"datacount"=>$dataCount];

    }

    
    public function showid($id)
    {
        //
        $data=DB::table('clubs')->find($id);
       
        return ['data'=>$data];

    }

    public function edit(Request $req,$id)
    {
        
        $data=DB::table('clubs')->where('id',$id)->update([
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
    
        $result=DB::table('clubs')->where('id',$id)->delete();
       
        return ["result"=> "failed to delete"];
          
    }
}
