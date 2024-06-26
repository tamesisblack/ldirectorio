<?php

namespace App\Livewire;

use App\Models\Director;
use Livewire\Component;
use DB;

class Directoriofiltro extends Component
{
    public function render()
    {
        $query = DB::SELECT("SELECT DISTINCT t.dep_nom FROM tm_directorio t ORDER BY t.dep_nom ASC");
        return view('livewire.directoriofiltro', ['data' => $query]);
    }
    public $selectedValue;
    public $filteredData;

    public function mount()
    {
        $this->selectedValue = null; // Inicializa el valor seleccionado
        $this->filteredData = []; // Inicializa el array de datos filtrados
    }
    public function filterData()
    {
        if ($this->selectedValue) {
            $this->filteredData = Director::where('dep_nom', $this->selectedValue)->get();
        } else {
            $this->filteredData = []; // Manejo por si no se selecciona ningún valor
        }
    }

}
