<?php

namespace App\Http\Controllers;

use App\Exports\UsersBioStarsExport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

class RapportController extends Controller
{
    //


    public function rapportUserByDayWeek($names)
    {
        $date = date('m');
        $biostars = DB::table('t_lg201909')
        ->select('SRVDT','USRID')
        ->where('EVT', '=' ,'4102' )
        ->where('DEVUID','=',$names)
        ->whereMonth('SRVDT',$date)
        ->distinct('SRVDT')
        ->get();
        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');


        return view('rapports.user',compact('biostars','names','lecteur'));

    }
    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Reponse;
     * @param [type] $names
     * @return void
     */
    public function dateAbsent($date,$names)
    {

        $results = DB::table('t_lg202105')
        ->select('USRID')
        ->where('EVT', '=' ,'4102')
        ->where('DEVUID','=',$names)
        ->where('USRID','!=',$date)
        ->distinct('USRID')
        ->get();

        $biostar = DB::table('t_lg202105')
        ->select('USRID')
        ->where('EVT', '=' ,'4102' )
        ->where('DEVUID','=',$names)
        ->whereDate('SRVDT','=',"$date")
        ->distinct('USRID')
        ->get();
        $user  = DB::table('t_usr')->get();

         $test = $this->objectToArray($biostar);

            if ($test == null) {

                return response()->json(null,200);
            }else{

                 # code...
                 $res = $this->objectToArray($results);
                 $reh =  array_diff($res,$test);

                 return response()->json($reh,200);


            }


    }

    public function redirect(Request $request)
    {
        $names = $request->lecteurs;
        return view('home',compact('names'));
    }

    public function choice()
    {
        $lecteurs = DB::table('t_devwgd')->get();
        $name = DB::table('t_dr')->get();

     //dd($lecteurs);

        return view('rapports.index',compact('lecteurs','name'));
    }

    public function rapportUserByEndMonth($names)
    {
        $biostars = DB::table('t_lg202105')
        ->select('SRVDT','USRID')
        ->where('EVT', '=' ,'4102' )
        ->where('DEVUID','=',$names)
        ->whereMonth('SRVDT',date('m'))
        ->distinct('SRVDT')
        ->get();
        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');

        $users  = DB::table('t_usr')->get();

        return view('rapports.month_presence',compact('users','biostars','names','lecteur'));
    }


    public function rapportUserByDayWork($names){

        $biostars = DB::table('t_lg202105')
        ->whereDate('SRVDT','=',now())
        ->where('EVT', '=' ,'4102' )
        ->where('DEVUID','=',$names)
        ->distinct('SRVDT')
        ->get();
        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');

        $user  = DB::table('t_usr')->get();



        return view('rapports.jour_work',compact('users','biostars','names','lecteur'));

    }


    public function rapportUserAbsencesByDate($names){
        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');
        return view('rapports.jour_absence_date',compact('names','lecteur'));
    }
    public function rapportUserByDayAbsent($names){



        $results = DB::table('t_lg202105')
        ->whereDate('SRVDT','=',now())
        ->where('EVT', '=' ,'4102' )
        ->where('DEVUID','=',$names)
        ->distinct('SRVDT')
        ->get('USRID');

       //    dd($results);

       $listes  = [];
            foreach($results  as $value){
                array_push($listes,$this->convertObjet($value));
            }
           // dd($results);
        $users  = DB::table('t_usr')->whereNotIn('USRID',$listes)->where('USRID','!=','_user_group_1')->where('USRID','!=','_visitor_group_1')->where('USRID','!=','0')->get();

        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');

        return view('rapports.jour_absent',compact('users','lecteur','names'));



    }


    public function rapportUserByTimesRetardSoir($names){

        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');
        $users  = DB::table('t_usr')->get();

        switch ($lecteur) {
            case 'ENTRER':
                # code...
                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';

                $soir = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();

        return view('rapports.times_retard_soir',compact('users','soir','debut_soir','fin_soir','names','lecteur'));

                break;

                case 'sortie':
                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';
                $soir = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                ->whereBetween('SRVDT',[$debut_soir,$fin_soir])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();

        return view('rapports.times_retard_soir',compact('users','soir','debut_soir','fin_soir','names','lecteur'));
                # code...
                break;

                case 'couloir':

                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';

                $soir = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                ->whereBetween('SRVDT',[$debut_soir,$fin_soir])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();

        return view('rapports.times_retard_soir',compact('users','soir','debut_soir','fin_soir','names','lecteur'));

                # code...
                break;

            default:
                # code...
                break;
        }


    }

    public function rapportUserByTimesRetardMatin($names){
        $users  = DB::table('t_usr')->get();


        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');

        switch ($lecteur) {
            case 'ENTRER':
                # code...

                $debut = '08:10';
                $fin = '11:59';

                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';


                $matin = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                //->whereBetween('SRVDT',[$debut,$fin])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();
                $soir = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();


        return view('rapports.times_retard_matin',compact('users','matin','soir','debut','fin','debut_soir','fin_soir','names','lecteur'));

                break;

                case 'sortie':
                $debut = '08:10';
                $fin = '11:59';

                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';


                $matin = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                //->whereBetween('SRVDT',[$debut,$fin])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();
                $soir = DB::table('t_lg202105')
                ->select('SRVDT','USRID')
                ->whereBetween('SRVDT',[$debut_soir,$fin_soir])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();

        return view('rapports.times_retard_matin',compact('users','matin','soir','debut','fin','debut_soir','fin_soir','names','lecteur'));




                # code...
                break;

                case 'couloir':
                $debut = '08:10';
                $fin = '11:59';

                //$debut_soir = date('Y-m-d'.' 13:10:00' ,time());
                $debut_soir = '13:10';
                $fin_soir = '18:00';


                $matin = DB::table('t_lg201909')
                ->select('SRVDT','USRID')
                //->whereBetween('SRVDT',[$debut,$fin])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();
                $soir = DB::table('t_lg201909')
                ->select('SRVDT','USRID')
                ->whereBetween('SRVDT',[$debut_soir,$fin_soir])
                ->where('EVT', '=' ,'4102' )
                ->where('DEVUID','=',$names)
                ->distinct('SRVDT')
                ->get();

        return view('rapports.times_retard_matin',compact('users','matin','soir','debut','fin','debut_soir','fin_soir','names','lecteur'));




                # code...
                break;

            default:
                # code...
                break;
        }


    }



    private function Start_End_Date_Week($week, $year)
    {
        $time  = strtotime("1 January $year",time());
        $day = date('W',$time);
        $time +=((7*$week)+1-$day)*24*3600;
        $date[0] = date('Y-n-j',$time);
        $time += 6*24*3600;
        $date[1] = date('Y-n-j',$time);

        return $date;
    }


    private function objectToArray($data)
    {
        $a = array();
        foreach($data as $k =>$v){
            $a[$k] = $v->USRID;
        }
        return $a;
    }


    private function convertObjet($data) {

         $response = [
            'USRID'=>intval($data->USRID)
        ];

        return $response;
    }


}
