<?php

namespace App\Livewire;

use App\Models\Filedata;
use Livewire\Component;
use Livewire\WithPagination;

class FiledataIndex extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';
    
    protected $paginationTheme = "bootstrap";
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $filedata= Filedata::where('pintura'    , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('modelo'     , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('certificado', 'LIKE', '%'. $this->search . '%')
                         ->orWhere('numero'     , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('masividad'  , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('m15'        , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('m30'        , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('m60'        , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('m90'        , 'LIKE', '%'. $this->search . '%')
                         ->orWhere('m120'       , 'LIKE', '%'. $this->search . '%')
                         ->orderby( $this->sort, $this->direction )
                         ->paginate(9);

        return view('livewire.filedata-index',compact('filedata'));
    }

    public function order($sort)
    {
        if ($this->sort==$sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort=$sort;
        }
    }
}
