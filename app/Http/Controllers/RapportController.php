<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    //

    public function rapportUserByEndMonth()
    {

        $abonners = DB::connection('mysql2')->table('abonners')->get();

        $taas = User::all();

       // dd($taas,$abonners);
       // dd($abonners);
        return view('rapports.user');
    }


    public function rapportUserByDayWork(){

        return view('rapports.jour_work');

    }


    public function rapportUserByDayAbsent(){

        return view('rapports.jour_absent');

    }


    public function rapportUserByTimesRetard(){

        return view('rapports.times_retard');

    }
}
