<?php

namespace App\Repositories;

use App\Models\Property;

class PropertyRepository
{
    public function getPaginated($filters, $perPage = 12)
    {
        $query = Property::query()->where('active', true);

        // 1. Búsqueda por texto
        if (!empty($filters['q'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'LIKE', '%' . $filters['q'] . '%')
                    ->orWhere('neighborhood', 'LIKE', '%' . $filters['q'] . '%')
                    ->orWhere('city', 'LIKE', '%' . $filters['q'] . '%')
                    ->orWhere('address', 'LIKE', '%' . $filters['q'] . '%');
            });
        }

        // 2. Tipo de Operación
        if (!empty($filters['tipo_operacion'])) {
            $operationMap = ['venta' => 'sale', 'renta' => 'rent'];
            $opDbValue = $operationMap[$filters['tipo_operacion']] ?? $filters['tipo_operacion'];
            $query->where('contract_type', $opDbValue);
        }

        // 3. Tipo de Propiedad
        if (!empty($filters['tipo_propiedad'])) {
            $typeMap = [
                'casa' => 'house',
                'departamento' => 'apartment',
                'terreno' => 'land',
                'local_comercial' => 'commercial_unit',
            ];
            $typeDbValue = $typeMap[$filters['tipo_propiedad']] ?? $filters['tipo_propiedad'];
            $query->where('type', $typeDbValue);
        }

        // 4. Filtro de Zona
        if (!empty($filters['zona'])) {
            $query->where('neighborhood', $filters['zona']);
        }

        // 5. Recámaras
        if (!empty($filters['recamaras'])) {
            $val = str_replace('+', '', $filters['recamaras']);
            str_contains($filters['recamaras'], '+')
                ? $query->where('bedrooms', '>=', $val)
                : $query->where('bedrooms', $val);
        }

        // 6. Baños
        $filterBanos = $filters['banos'] ?? $filters['bathrooms'] ?? null;
        if (!empty($filterBanos)) {
            $val = str_replace('+', '', $filterBanos);
            str_contains($filterBanos, '+')
                ? $query->where('bathrooms', '>=', $val)
                : $query->where('bathrooms', $val);
        }

        // 7. Precios
        if (!empty($filters['precio_min'])) {
            $query->where('price', '>=', $filters['precio_min']);
        }
        if (!empty($filters['precio_max'])) {
            $query->where('price', '<=', $filters['precio_max']);
        }

        // --- NUEVO: 9. Filtro de Amenidades ---
        // Verificamos que vengan amenidades y que sea un array
        if (!empty($filters['amenities']) && is_array($filters['amenities'])) {
            foreach ($filters['amenities'] as $amenityId) {
                $query->whereHas('amenities', function ($q) use ($amenityId) {
                    $q->where('amenities.id', $amenityId);
                });
            }
        }

        // 8. Ordenamiento
        $query->orderBy($filters['sort_by'] ?? 'created_at', $filters['sort_order'] ?? 'desc');

        return $query->paginate($perPage)->withQueryString();
    }
    public function getAllNeighborhoods()
    {
        return Property::distinct()->pluck('neighborhood')->filter()->toArray();
    }

    public function getAllAmenities()
    {
        // Asumiendo que tienes una relación 'amenities' en tu modelo Property
        return Property::with('amenities')->get()->pluck('amenities')->flatten()->unique('id')->values();
    }

    public function findBySlug(string $slug)
    {
        return Property::with(['images', 'thumbnail', 'seller'])
            ->where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
    }


}