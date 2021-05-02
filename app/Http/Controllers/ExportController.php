<?php

namespace App\Http\Controllers;

use App\Exports\RetardBioStarsExport;
use Illuminate\Http\Request;
use App\Exports\UsersBioStarsExport;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class ExportController extends Controller
{
    //
    public function csvBiostarExport($type){


        if($type == 'xlsx'){

            return Excel::download(new RetardBioStarsExport,'usersbiostar.xlsx');

        }else{
            return Excel::download(new UsersBioStarsExport,'usersbiostar.csv');

        }

    }
    public function pdfBiostar(){


        $biostars = DB::table('t_lg201909_copy')
        ->where('USRID', '!=' ,'' )
        ->distinct('USRID')
        ->get();

        $pdf = Pdf::loadView('rapport.pdf',$biostars);
        return $pdf->download('tuto.pdf');

    }
}
