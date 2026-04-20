<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use App\Models\Marca;

class NavbarFilters extends Component
{
    public $marcas;

    public function __construct()
    {
        // Esta es la lógica que quitaremos del controlador
        $this->marcas = Marca::active()
            ->with(['autos' => function ($query) {
                $query->active()
                    ->select('id_marca', 'modelo')
                    ->selectRaw('count(*) as total')
                    ->groupBy('id_marca', 'modelo')
                    ->orderBy('modelo', 'asc');
            }])
            ->has('autos')
            ->orderBy('nombre', 'asc')
            ->get();
    }

    public function render()
    {
        return view('components.dashboard.navbar-filters');
    }
}