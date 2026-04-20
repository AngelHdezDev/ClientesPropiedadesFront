<?php

namespace App\Services;

use App\Repositories\PropertyRepository;

class PropertyService
{
    protected $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCatalogData($filters)
    {
        $properties = $this->repository->getPaginated($filters);

        $properties->getCollection()->transform(function ($prop) {
            $prop->thumbnail_url = $prop->thumbnail 
                ? config('app.admin_storage') . $prop->thumbnail->path 
                : null;

            return $prop;
        });

        return $properties;
    }

    public function getFiltersData()
    {
        return [
            'zonas' => $this->repository->getAllNeighborhoods(),
            'amenities' => $this->repository->getAllAmenities(),
        ];
    }

    public function getPropertyDetail(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }
}