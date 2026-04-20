<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use App\Models\Marca;
use App\Models\Auto;

class FavoriteBrands extends Component
{
    public $marcas;
    public $autos;

    public function __construct()
    {
        // 1. Traemos las marcas que tengan autos activos
        $this->marcas = Marca::active()
            ->has('autos')
            ->get();

        // 2. Traemos los 5 autos más recientes para el carrusel
        $this->autos = Auto::active()
            ->with(['marca', 'thumbnail']) // Eager loading para evitar el problema N+1
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('components.dashboard.favorite-brands');
    }
}