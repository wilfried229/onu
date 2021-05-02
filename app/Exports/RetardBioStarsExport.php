<?php

namespace App\Exports;

use App\UsersBioStars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;


class RetardBioStarsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $biostars = DB::table('t_lg201909')
        ->where('EVT', '=' ,'4102' )
        ->distinct('USRID')
        ->get();

        return $biostars;
    }
}
