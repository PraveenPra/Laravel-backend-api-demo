<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Hospital;

class AdminDashboardController extends Controller
{
    //
    public function counts()
    {
        $HospitalsCount=DB::table('hospitals')->count();
        $DoctorsCount=DB::table('doctors')->count();
        $CorporatesCount=DB::table('corporates')->count();
        $DonorsCount=DB::table('donors')->count();
        $ClubsCount=DB::table('clubs')->count();
        // $HospitalsCount=DB::table('hospitals')->count();
        return [
            'hospitals'=>$HospitalsCount,
            'doctors'=> $DoctorsCount,
            'corporates'=> $CorporatesCount,
            'donors'=>  $DonorsCount,
            'clubs'=>$ClubsCount,
        ];
    }

}
