<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use App\Models\Marca;

class BrandCatalog extends Component
{
    public $marcas;

    public function __construct()
    {
        $this->marcas = Marca::active()
            ->has('autos') // Esto filtra las marcas que tienen 0 autos de golpe
            ->withCount([
                'autos' => function ($query) {
                    $query->active();
                }
            ])
            ->orderBy('nombre', 'asc')
            ->get();
    }

    public function render()
    {
        return view('components.dashboard.brand-catalog');
    }
}