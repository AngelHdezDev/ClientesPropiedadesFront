<?php

namespace App\Repositories;

use App\Models\Property;
use App\Models\PropertyImage;

class DashboardRepository
{
    public function getHeroImage()
    {
        return PropertyImage::where('is_hero', 1)
            ->latest()
            ->first() ?? PropertyImage::where('is_main', 1)->latest()->first();
    }

    public function getFeaturedProperties($limit = 6)
    {
        return Property::with(['thumbnail'])
            ->where('active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->take($limit)
            ->get();
    }
    

    public function getStats()
    {
        return [
            'total_disponibles' => Property::where('status', 1)->count(),
            'total_zonas' => Property::where('status', 1)->distinct('state')->count('state'),
        ];
    }
}