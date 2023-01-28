<?php

namespace App\Exports;

use App\Models\Filedata;
use Maatwebsite\Excel\Concerns\FromCollection;

class FiledataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Filedata::select("pintura","modelo", "certificado","numero", "masividad", "m15", "m30", "m60", "m90")->get();
    }
}
