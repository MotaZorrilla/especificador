<?php

namespace App\Imports;

use App\Models\Filedata;
use Maatwebsite\Excel\Concerns\ToModel;

class FiledataImport implements ToModel
{
    public function model(array $row)
    {
        return new Filedata([
            'pintura'       => $row[0],
            'modelo'        => $row[1],
            'certificado'   => $row[2],      
            'numero'        => $row[3],
            'masividad'     => $row[4],
            'm15'           => $row[5],
            'm30'           => $row[6],
            'm60'           => $row[7],
            'm90'           => $row[8],
            'm120'          => $row[9], 
            'p4c'           => $row[10],
            'v4c'           => $row[11],
            'v3c'           => $row[12],
            'abierta'       => $row[13],
            'rectangular'   => $row[14],
            'circular'      => $row[15]
        ]);
    }
}
