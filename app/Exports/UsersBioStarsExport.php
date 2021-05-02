<?php

namespace App\Exports;

use App\UsersBioStars;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersBioStarsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UsersBioStars::all();
    }
}
