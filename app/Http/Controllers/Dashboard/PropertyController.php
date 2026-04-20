<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $service;

    public function __construct(PropertyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $properties = $this->service->getCatalogData($request->all());
        $filtersData = $this->service->getFiltersData();

        return view('catalogoPropiedades', [
            'properties' => $properties,
            'zonas'      => $filtersData['zonas'],
            'amenities'  => $filtersData['amenities'] ?? []
        ]);
    }


    public function show($slug)
    {
        $property = $this->service->getPropertyDetail($slug);

        return view('propiedadDetalle', compact('property'));
    }
}