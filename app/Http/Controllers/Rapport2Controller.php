<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PDO;

class Rapport2Controller extends Controller
{


    // cumille des retard
    public function cumileAbsences(Request $request,$departement){

        $cumulesAbsences = array();

        $user = array();
        $nbjourAbsent = "";

        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');


        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();

        if ($request->date_debut ) {

            $user = DB::connection('sqlsrv')->table('TB_USER')
            ->select('sUserName','sUserID')
            ->where('nDepartmentIdn',$departement)
            ->where('sUserID',$request->matricule)
            ->get();

            $dateDebut = $request->date_debut;
            $dateFin = $request->date_fin;
            $year = date('Y',strtotime($dateDebut));

            $moisDebut = date('m',strtotime($dateDebut));
            $moisFin = date('m',strtotime($dateFin));
            $jourDebut = date('d',strtotime($dateDebut));
            $jourFin = date('d',strtotime($dateFin));



            $test = DB::connection('sqlsrv')->select("
            select nUserID,dateadd(s,nDateTime+3600, '1970-01-01') as date_type  from TB_EVENT_FACE,TB_USER  where
            nEventIdn='61' and nUserID='$request->matricule'
            and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
               and  TB_USER.nDepartmentIdn = $departement
            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin
            and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))  between $jourDebut and $jourFin");

            $cumile = DB::connection('sqlsrv')->select("select nUserID,dateadd(ss,nDateTime+3600, '1970-01-01') as date_type
            from TB_EVENT_FACE,TB_USER  where  nEventIdn=61 and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
            and  TB_USER.nDepartmentIdn = $departement
            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin
            and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))  between $jourDebut and $jourFin");

            $totalHeureRetard = $this->calculDesMinutes($test);


            if (empty($totalHeureRetard)) {

                $totalHeureRetard = 0;
                # code...
            }

            $arrayTest = $this->objectToArrayTest($test);

           $date1 =strtotime($dateDebut);// first days
            $date2 =strtotime($dateFin);// seconde days

            $nbjour = ($date2-$date1)/60/60/24;// count days

            $cimules = array();
            for($i= 0;$i<=$nbjour;$i++){
                $cimules[$i] = date('Y-m-d',$date1);
                $date1 += 60*60*24;
            }

            if ($test == "") {
                # code...
                $cumulesAbsences = array();
            }
            $cumulesAbsences =  array_diff($cimules,$arrayTest);


            $nbjourAbsent = count($cumulesAbsences);


/*             $results = array_merge($cimulesAbsences,$arrayTest);
            $biostas = array_unique($results);

            dd($biostas,$arrayTest);
 */
            $date_df = Carbon::parse('2019-09-30 08:00:42.000');
            $datS = Carbon::parse('2019-09-30 08:20:42.000');

            $diffs =$datS->diffInMinutes($date_df);

            $date1 =strtotime('2019-10-80');// first days
            $date2 =strtotime('2019-10-30');// seconde days

           // $cimulesAbsences = $this->cumilesAbsences($dateDebut,$dateFin);

            # code...
        return view('rapports1.cumille_absence',compact('debut','user','cumulesAbsences','nbjourAbsent','fin','test','departement','departements','users','date'));

        }


        $test = [];
        return view('rapports1.cumille_absence',compact('debut','user','cumulesAbsences','nbjourAbsent','fin','test','departement','departements','users','date'));


    }

    // cumille des retard
    public function cumilleRetard(Request $request,$departement){


        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $converMinitesEnHeure ="";
        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement
        ");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();

        $totalHeureRetard ="";
        if ($request->date_debut ) {

            $dateDebut = $request->date_debut;
            $dateFin = $request->date_fin;
            $year = date('Y',strtotime($dateDebut));

            $moisDebut = date('m',strtotime($dateDebut));
            $moisFin = date('m',strtotime($dateFin));
            $jourDebut = date('d',strtotime($dateDebut));
            $jourFin = date('d',strtotime($dateFin));



            $test = DB::connection('sqlsrv')->select("select nUserID,dateadd(s,nDateTime, '1970-01-01') as date_type
                                    from TB_EVENT_FACE,TB_USER where nEventIdn='61'
                                    and TB_USER.sUserID = TB_EVENT_FACE.nUserID
                                    and  TB_USER.nDepartmentIdn = $departement
                                    and nUserID='$request->matricule'
                                    and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
                                    and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin
                                    and datepart(d,dateadd(S,nDateTime-21600, '1970-01-01')) between $jourDebut and $jourFin
                                    and datepart(hour,dateadd(s,nDateTime, '1970-01-01')) between 08 and 10 ");





           // $cumile = DB::connection('sqlsrv')->select("select nUserID,dateadd(ss,nDateTime+3600, '1970-01-01') as date_type from TB_EVENT_FACE where nReaderIdn='$names' and nEventIdn=61 and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))  between $jourDebut and $jourFin");

           $test2 = DB::connection('sqlsrv')->select("select nUserID,dateadd(s,nDateTime, '1970-01-01') as date_type
           from TB_EVENT_FACE,TB_USER where nEventIdn='61'
           and TB_USER.sUserID = TB_EVENT_FACE.nUserID
           and  TB_USER.nDepartmentIdn = $departement
           and nUserID='$request->matricule'
           and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
           and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin
           and datepart(d,dateadd(S,nDateTime-21600, '1970-01-01')) between $jourDebut and $jourFin
           and datepart(hour,dateadd(s,nDateTime, '1970-01-01')) between 13 and 16
           ");

            $totalHeureRetard = $this->calculDesMinutes($test);
            $totalHeureRetard2 = $this->calculDesMinutes2($test2);

            if(!empty($totalHeureRetard) and !empty($totalHeureRetard2)) {


                $totalesHours  = $totalHeureRetard+$totalHeureRetard2;

                $converMinitesEnHeure = date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$totalesHours));


            }else if(empty($totalHeureRetard) and !empty($totalHeureRetard2)) {

                $totalesHours  = $totalHeureRetard2;

                $converMinitesEnHeure = date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$totalesHours));

            }else if(!empty($totalHeureRetard) and empty($totalHeureRetard2)) {

                $totalesHours  = $totalHeureRetard;

                $converMinitesEnHeure = date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$totalesHours));

            }

            else{


                $converMinitesEnHeure = 0;

            }




            $allResultss = [];



            //dd($totalHeureRetard,$test,$test2,$totalHeureRetard2,$converMinitesEnHeure);

          //  dd($totalHeureRetard,$test);




        return view('rapports1.cumille_retard',compact('departement','debut','cimulesAbsences','converMinitesEnHeure','fin','test','test2'  ,'departements','users','date'));

        }


        $test = [];
        $test2 = [];
        return view('rapports1.cumille_retard',compact('departement','debut','fin','cimulesAbsences','converMinitesEnHeure','test', 'test2','departements','users','date'));


    }

    public function searchDateByallUser(Request $request, $departement){

        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $motif = "Heur de pause";

        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement
        ");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();


       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        if ($request->date_debut ) {


            $dateDebut = $request->date_debut;
            $dateFin = $request->date_fin;
            $year = date('Y',strtotime($dateDebut));

            $moisDebut = date('m',strtotime($dateDebut));
            $moisFin = date('m',strtotime($dateFin));
            $jourDebut = date('d',strtotime($dateDebut));
            $jourFin = date('d',strtotime($dateFin));



        $test = DB::connection('sqlsrv')->select("select nUserID,sUserName, dateadd(s,nDateTime+3600, '1970-01-01') as date_type
                             from TB_EVENT_FACE,TB_USER  where nEventIdn='61'
                            and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
                            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
                            and  TB_USER.nDepartmentIdn = $departement
                            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) = $moisDebut
                            and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01')) = $jourDebut");

        $arrayTest = $this->objectToArrayTest($test);
            # code...
        return view('rapports1.seach_date',compact('departement','debut','test','fin','countDays','biostars1','departements','users','date'));

        }


        $test = [];
        return view('rapports1.seach_date',compact('departement','debut','fin','test','countDays','biostars1','departements','users','date'));


    }




    // cimule des jour travaillés

    public function searchDate(Request $request, $departement){


        $countDays = "";
        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $motif = "Heur de pause";

        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement
        ");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        if ($request->date_debut ) {

            $dateDebut = $request->date_debut;
            $dateFin = $request->date_fin;
            $year = date('Y',strtotime($dateDebut));

            $moisDebut = date('m',strtotime($dateDebut));
            $moisFin = date('m',strtotime($dateFin));
            $jourDebut = date('d',strtotime($dateDebut));
            $jourFin = date('d',strtotime($dateFin));



        $test = DB::connection('sqlsrv')->select("select nUserID,dateadd(s,nDateTime+3600, '1970-01-01') as date_type
                             from TB_EVENT_FACE,TB_USER  where nEventIdn='61'
                            and nUserID='$request->matricule'
                            and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year
                            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
                            and  TB_USER.nDepartmentIdn = $departement
                            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin
                            and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))  between $jourDebut and $jourFin");

        $arrayTest = $this->objectToArrayTest($test);
         $cumuleJourTravail  = array_unique($arrayTest);

         $countDays = count($cumuleJourTravail);

           // $cumile = DB::connection('sqlsrv')->select("select nUserID,dateadd(ss,nDateTime+3600, '1970-01-01') as date_type from TB_EVENT_FACE where nReaderIdn='$names' and nEventIdn=61 and datepart(year,dateadd(S,nDateTime-21600, '1970-01-01'))=$year and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01')) between $moisDebut and  $moisFin and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))  between $jourDebut and $jourFin");

            # code...

            return view('rapports1.search',compact('cumuleJourTravail','departement','debut','fin','countDays','biostars1','departements','users','date'));

        }




        $cumuleJourTravail = [];
        return view('rapports1.search',compact('cumuleJourTravail','departement','debut','fin','countDays','biostars1','departements','users','date'));

    }



    // HEURE d'entré par équipe avnt 13h
    public function heureEntrer($departement){


        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');



        $heureEntrerMatin = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();



        switch ($departement) {
            case '1':
                # code... admin
                $debut = '12:15';
                $fin = '13:05';

        return view('rapports1.heure_entrer',compact('debut','fin','heureEntrerMatin','departement','departements','users','date'));

                break;

                case '4':
 # code... COSMETIQUE
                $debut = '12:15';
                $fin = '13:05';

                return view('rapports1.heure_entrer',compact('debut','fin','heureEntrerMatin','departement','departements','users','date'));

                # code...
                break;

                case '2':
   # c PLATISQUE]
                $debut = '12:00';
                $fin = '13:05';


        return view('rapports1.heure_entrer',compact('debut','fin','heureEntrerMatin','departement','departements','users','date'));


                break;

                case '542183563':
              # code...  PLASTIQUE 6H[192.168.1.95]
                $debut = '06:00';
                $fin = '14:05';


        return view('rapports1.heure_entrer',compact('debut','fin','heureEntrerMatin','departement','departements','users','date'));

    break;

         default:
                # code...
                break;
        }


    }


    public function heureSortiesmartin($departement){


        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $motif = "Heur de pause";

        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        switch ($departement) {
            case '1':
                # code... admin
                $debut = '11:45';
                $fin = '12:20';



        return view('rapports1.heure_sorties',compact('debut','motif','fin','heureSortie','departement','departements','users','date'));

                break;



                case '4':
 # code... COSMETIQUE
              $debut = '11:45';
                $fin = '12:20';

                return view('rapports1.heure_sorties',compact('debut','motif','fin','heureSortie','departement','departements','users','date'));


                break;
                //equipe C


                case '542183563':
              # code...  PLASTIQUE 6H[192.168.1.95]
                $debut = '06:00';
                $fin = '05:15';

        return view('rapports1.heure_sorties',compact('debut','fin','motif','heureSortie','departement','departements','users','date'));

        break;
        //equipe d


        case '542183562':
        # code...PLASTIQUE 14H[192.168.1.95]
        $debut = '06:00';
        $fin = '05:15';

        return view('rapports1.heure_sorties',compact('debut','fin','motif','heureSortie','departement','departements','users','date'));


            default:
                # code...
                break;
        }


    }

    public function heureSortiesSoir($departement){


        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $motif = 'Heur de fin';

        $heureSortie = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        switch ($departement) {
            case '1':
                # code... admin
                $debut = '16:45';
                $fin = '18:00';



        return view('rapports1.heure_sorties',compact('debut','fin','motif','heureSortie','departement','departements','users','date'));

                break;



                case '4':
 # code... COSMETIQUE $debut = '17:00';
                    $debut = '16:45';
                    $fin = '18:00';

                return view('rapports1.heure_sorties',compact('debut','fin','motif','heureSortie','departement','departements','users','date'));


                break;
                //equipe C


                case '542183563':
              # code...  PLASTIQUE 6H[192.168.1.95]
              $debut = '17:00';
              $fin = '18:00';

        return view('rapports1.heure_sorties',compact('debut','fin','heureSortie','motif','departement','departements','users','date'));

        break;
        //equipe d


        case '542183562':
        # code...PLASTIQUE 14H[192.168.1.95]
                $debut = '17:00';
                $fin = '18:00';

        return view('rapports1.heure_sorties',compact('debut','fin','heureSortie','motif','departement','departements','users','date'));


            default:
                # code...
                break;
        }


    }
    public function rapportUserAbsencesByDate($names){
        $lecteur = DB::table('t_dr')
        ->where('INSDEVUID','=',$names)
        ->value('NM');
        return view('rapports.jour_absence_date',compact('names','lecteur'));
    }

    // rapport par département
    public function redirect(Request $request)
    {

        $departement = $request->departement;
        //dd($names);

        return view('home1',compact('departement'));
    }


    public function choice()
    {

      //  $lecteurs = DB::connection('sqlsrv')->table('TB_READER')->get();
       // $name = DB::connection('sqlsrv')->table('TB_READER')->get();
        $departement  = DB::connection('sqlsrv')->table('TB_USER_DEPT')->get();
        return view('rapports1.index2',compact('departement'));
    }

    public function rapportUserByEndMonth($departement)
    {

        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $month= DB::connection('sqlsrv')->select("select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();


        return view('rapports1.user',compact('month','departement','departements','date'));
    }

    public function rapportUserByDayWork($departement){

        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

       /*  $biostars = DB::connection('sqlsrv')->table('TB_EVENT_FACE')
        ->select('nDateTime','nUserID')
        ->where('nEventIdn', '=' ,'61' )
        ->get();
   */



        $days = DB::connection('sqlsrv')->select("select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
                                            from TB_EVENT_FACE,TB_USER  where nEventIdn=61
                                            and  datepart(dd,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
                                            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
                                            and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
                                            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
                                            and  TB_USER.nDepartmentIdn = $departement");



                                            // $biostars1 =$this->objectToArray($biostars);

        //$dateInt = date_create($date);
       // $conversion = date_format($dateInt,'U');

      /*  $users = DB::connection('sqlsrv')->table('TB_USER')
        ->select('sUserName','sUserID')
        ->where('nDepartmentIdn',$departement)
        ->get();
 */
       // dd($users);

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();



        return view('rapports1.jour_work',compact( 'days','departement','departements','date'));

    }

    /**
     * les asbsences par jour
     *
     * @param [type] $names
     * @return void
     */
    public function rapportUserByDayAbsent($departement){

        $date_now = date('d');

        $date_month  = date('m');
        $date_year = date('Y');



        $now = DB::connection('sqlsrv')->select("select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
                                            from TB_EVENT_FACE,TB_USER  where nEventIdn=61
                                            and  datepart(dd,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_now
                                            and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
                                            and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
                                            and TB_USER.sUserID = TB_EVENT_FACE.nUserID
                                            and  TB_USER.nDepartmentIdn = $departement");




        $nosw = DB::connection('sqlsrv')->select("select nUserID,datepart(dd,dateadd(S,nDateTime, '1970-01-01')) as date_type from TB_EVENT_FACE where   nEventIdn=61 and  datepart(dd,dateadd(S,nDateTime-21600, '1970-01-01'))='$date_now' and datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))='$date_month' ");
        $last = DB::connection('sqlsrv')->select("
        select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $users = DB::connection('sqlsrv')->table('TB_USER')
        ->select('sUserName','sUserID')
        ->where('nDepartmentIdn',$departement)
        ->get();


        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       /// $test = DB::connection('sqlsrv')->select("select nUserID,datepart(hour,dateadd(S,nDateTime+3600, '1970-01-01')) as dateHeur, datepart(hour,dateadd(S,nDateTime+3600, '1970-01-01')) as dateJour, datepart(minute,dateadd(S,nDateTime-21600, '1970-01-01')) as dateMinute from TB_EVENT_FACE  where nReaderIdn='$names' and nEventIdn=61 and  datepart(dd,dateadd(S,nDateTime-21600, '1970-01-01'))='$date_now' ");


            $search_now = $this->objectToArray2 ($now);

            $search_last = $this->objectToArray4($users);
           //$search_test = $this->objectToArray3($test);

           /*  il faudra verifier l'heur de chaque equipe  de search_test */

            if($now == null)
            {
                $biostars = $last;
                return view('rapports1.absenceN',compact('biostars','users','departements','departement'));
            }else
            {
                $uniquesSeacheNow = array_unique($search_now);

               // $tv = array_diff($search_last,$search_now,$search_last);

                //$bios =  array_diff($search_last,$search_now);


                //$results = array_merge($bios,$search_test);


                $checkeds = array_diff($search_last,$uniquesSeacheNow);

                $biostars = $checkeds;

               // dd($uniquesSeacheNow,$search_last,$checkeds); verification absence (05/12/2019)
                //$biostars = array_unique($bios);

                return view('rapports1.absence',compact('biostars','names','users','departements','departement'));
            }


    }



    // retard du matin par equipe

    public function rapportUserByTimesRetardMatin($departement)
    {



        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $retardMatin= DB::connection('sqlsrv')->select("select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        switch ($departement) {
            case '1':
                # code... admin
                $debut = '08:01';
                $fin = '11:00';


        return view('rapports1.retard_matin',compact('debut','departement','departements','retardMatin','fin','users','date'));

                break;

                case '4':
 # code... COSMETIQUE
                $debut = '08:01';
                $fin = '11:00';
  /*
        $biostars = DB::connection('sqlsrv')->table('TB_EVENT_FACE')
        ->select('nDateTime','nUserID')
        ->where('nEventIdn', '=' ,'61' )
        ->where('nReaderIdn','=',$names)
        ->get();
     ///   $retardMatiDn = DB::connection('sqlsrv')->select("select nUserID,dateadd(s,nDateTime, '1970-01-01') as date_type from TB_EVENT_FACE where nReaderIdn='$names' and nEventIdn=61 and  datepart(dd,dateadd(S,nDateTime-21600, '1970-01-01'))=$date and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month ");
        $biostars1 =$this->objectToArray($biostars); */
        return view('rapports1.retard_matin',compact('debut','departement','departements','retardMatin','fin','users','date'));

                # code...
                break;


                case '542183563':
              # code...  PLASTIQUE 6H[192.168.1.95]
                $debut = '08:01';
                $fin = '11:00';


        return view('rapports1.retard_matin',compact('debut','departement','departements','retardMatin','fin','users','date'));


                 break;

                case '542183562':
                # code...PLASTIQUE 14H[192.168.1.95]
                $debut = '08:01';
                $fin = '11:00';


        return view('rapports1.retard_matin',compact('debut','departement','departements','retardMatin','fin','users','date'));
            break;

            default:
                # code...
                break;
        }


    }

    //  retard du soir  par equipe
    public function rapportUserByTimesRetardSoir($departement){


        $date = date('d');
        $date_month = date('m');
        $date_year = date('Y');

        $retardSoir = DB::connection('sqlsrv')->select("select nUserID,sUserName,dateadd(s,nDateTime, '1970-01-01') as date_type
        from TB_EVENT_FACE,TB_USER  where nEventIdn=61
        and  datepart(d,dateadd(S,nDateTime-21600, '1970-01-01'))=$date
        and  datepart(m,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_month
        and  datepart(yy,dateadd(S,nDateTime-21600, '1970-01-01'))=$date_year
        and TB_USER.sUserID = TB_EVENT_FACE.nUserID
        and  TB_USER.nDepartmentIdn = $departement");

        $departements  = DB::connection('sqlsrv')->table('TB_USER_DEPT')
        ->where('nDepartmentIdn',$departement)
       ->get('sName')->first();

       $users = DB::connection('sqlsrv')->table('TB_USER')
       ->select('sUserName','sUserID')
       ->where('nDepartmentIdn',$departement)
       ->get();


        switch ($departement) {
            case '1':
                # code... admin


                $debut = '13:01';
                $fin =  '16:00';
        return view('rapports1.retard_soir',compact('debut','retardSoir','fin','departement','departements','users','date'));

                break;

                case '4':
 # code... COSMETIQUE ]
                $debut  = '13:01';
                $fin =  '16:00';
        return view('rapports1.retard_soir',compact('debut','retardSoir','fin','departement','departements','users','date'));


                break;

                case '542183563':
                # code...  PLASTIQUE 6H[192.168.1.95]
                $debut  = '13:01';
                $fin  =  '16:00';
                return view('rapports1.retard_soir',compact('debut','retardSoir','fin','departement','departements','users','date'));
            break;

                case '542183562':
 # code...PLASTIQUE 14H[192.168.1.95]
                $debut  = '14:15';
                $fin  =  '16:00';

                return view('rapports1.retard_soir',compact('debut','retardSoir','fin','departement','departements','users','date'));

                break;


            default:
                # code...
                break;
        }


    }


    /// conversion de users test in array

    private function objectToArrayTest($data)
    {
        $a = array();
        foreach($data as $k =>$v){
            $a[$k] = date('Y-m-d',strtotime($v->date_type));
        }
        return $a;

//        return $b;
    }

    private function objectToArray($data)
    {
        $a = array();
        $b = array();
        foreach($data as $k =>$v){
            $a[$k] = array($v->nUserID,date('Y-m-d H:i:s',$v->nDateTime));
            $b[$k]  = date('Y-m-d H:i:s',$v->nDateTime);
        }
        return ['a'=>$a, 'b' =>$b];

//        return $b;
    }


    private function objectToArray2($data)
    {
        $a = array();
        foreach($data as $k =>$v){
            $a[$k] =$v->nUserID;
        }
        return $a;
    }


    private function objectToArray4($data)
    {
        $a = array();
        foreach($data as $k =>$v){
            $a[$k] =$v->sUserID;
        }
        return $a;
    }

    /// remove methode
    private function objectToArray3($data){

        $a = array();
        foreach($data as $k =>$v){

            if($v->dateHeur == 8 and $v->dateMinute >= 42){
                $a[$k] =$v->nUserID;
            }
        }
        return $a;
    }

    private function calculDesMinutes2($data){

        $totalesHeuresRetardEnMinites = array();

        $sommesMinutes = 0;
        $sommesHeures = 0;

        foreach($data as $k =>$v){

                $a[$k] =$v->nUserID;

                $dateconver[$k] = date('Y-m-d',strtotime($v->date_type));

                $dateBase[$k] = Carbon::parse('2019-09-30 13:01:00.000');
                $dateSub[$k] = Carbon::parse($v->date_type);

                $diffs[$k] =$dateSub[$k]->diffInMinutes($dateBase[$k]);

                $t =$diffs;
                $heurs[$k]  = date('G',mktime(0,$diffs[$k]));

                $minutes[$k]  = date('i',mktime(0,$diffs[$k]));

                $h[$k] = floor($t[$k]/3600) ? floor($t[$k]/3600). ' Heur' : '';

                $sommesMinutes += $minutes[$k];
                $sommesHeures += $heurs[$k];
                $converEnHeureMinutes = $sommesHeures *60;
                $respHeurMinutes=  $converEnHeureMinutes + $sommesMinutes;
               // $converMinitesEnHeure = date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$respHeurMinutes));
            $totalesHeuresRetardEnMinites = $respHeurMinutes;
        }
        return $totalesHeuresRetardEnMinites;
    }


    private function calculDesMinutes($data){

        $totalesHeuresRetardEnMinites = array();

        $sommesMinutes = 0;
        $sommesHeures = 0;

        foreach($data as $k =>$v){

                $a[$k] =$v->nUserID;

                $dateconver[$k] = date('Y-m-d',strtotime($v->date_type));

                $dateBase[$k] = Carbon::parse('2019-09-30 08:00:00.000');
                $dateSub[$k] = Carbon::parse($v->date_type);

                $diffs[$k] =$dateSub[$k]->diffInMinutes($dateBase[$k]);

                $t =$diffs;
                $heurs[$k]  = date('G',mktime(0,$diffs[$k]));

                $minutes[$k]  = date('i',mktime(0,$diffs[$k]));

                $h[$k] = floor($t[$k]/3600) ? floor($t[$k]/3600). ' Heur' : '';

                $sommesMinutes += $minutes[$k];
                $sommesHeures += $heurs[$k];
                $converEnHeureMinutes = $sommesHeures *60;
                $respHeurMinutes=  $converEnHeureMinutes + $sommesMinutes;
               // $converMinitesEnHeure = date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$respHeurMinutes));

                $totalesHeuresRetardEnMinites = $respHeurMinutes;
        }
        return $totalesHeuresRetardEnMinites;
    }

    //cumile des absences

    private function cumilesAbsences($date_debut,$date_fin){


        $date1 =strtotime($date_debut);// first days
        $date2 =strtotime($date_fin);// seconde days

        $nbjour = ($date2-$date1)/60/60/24;// count days

        $dateAbsent = array();
        for($i= 0;$i<=$nbjour;$i++){

            $dateAbsent[$i] = date('Y-m-d',$date1);
        }

        return $dateAbsent;
    }



}
