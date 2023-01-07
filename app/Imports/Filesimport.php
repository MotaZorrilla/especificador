<?php

namespace App\Imports;

use App\Models\File;
use Maatwebsite\Excel\Concerns\ToModel;

class Filesimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new File([
            'pintura'       => $row[0],
            'modelo'        => $row[1],
            'certificado'   => $row[2],      
            'numero'        => $row[3],
            'masividad'     => $row[4],
            'm15'           => $row[5],
            'm30'           => $row[6],
            'm60'           => $row[7],
            'm90'           => $row[8],  
        ]);
    }
}
