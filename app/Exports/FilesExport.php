<?php

namespace App\Exports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\FromCollection;

class FilesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return File::select("pintura","modelo", "certificado","numero", "masividad", "m15", "m30", "m60", "m90")->get();
    }
}
