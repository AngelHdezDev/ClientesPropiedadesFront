<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $repo;

    public function __construct(DashboardRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getDashboardData()
    {
        $adminUrl = env('ADMIN_STORAGE_URL');
        $hero = $this->repo->getHeroImage();
        $featured = $this->repo->getFeaturedProperties();

        $featured->map(function ($prop) use ($adminUrl) {
            $prop->thumbnail_url = $prop->thumbnail
                ? $adminUrl . $prop->thumbnail->path
                : asset('images/placeholder.jpg');
            return $prop;
        });

        return [
            'hero_path' => $hero ? $adminUrl . $hero->path : null,
            'featured_properties' => $featured,
        ];
    }

    private function obtenerSaludo()
    {
        $hora = date('H');
        if ($hora < 12)
            return "¡Buenos días!";
        if ($hora < 19)
            return "¡Buenas tardes!";
        return "¡Buenas noches!";
    }
}