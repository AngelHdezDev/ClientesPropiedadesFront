<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Auto;
use App\Models\Marca;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;


class AutoController extends Controller
{

    public function index(Request $request)
    {
        if (!$request->has('price_min') && !$request->ajax()) {
            return redirect()->route('autos.index', array_merge([
                'sort' => 'latest',
                'price_min' => 0,
                'price_max' => 3500000,
                'km_min' => 0,
                'km_max' => 500000,
                'search' => '',
            ], $request->all()));
        }
        // 1. OBTENER LAS MARCAS
        // Quitamos ->with('modelos') porque esa relación no existe en tu modelo Marca
        $marcas = Marca::active()
            ->withCount([
                'autos' => function ($query) {
                    $query->where('active', 1); // Solo cuenta los activos
                }
            ])
            ->orderBy('nombre', 'asc')
            ->has('autos')
            ->get();

        try {
            $query = Auto::active()->with(['marca', 'thumbnail']);

            // 2. BÚSQUEDA (Texto libre)
            $query->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                return $q->where(function ($sub) use ($search) {
                    $sub->where('modelo', 'LIKE', "%{$search}%")
                        ->orWhere('color', 'LIKE', "%{$search}%")
                        ->orWhere('year', 'LIKE', "%{$search}%")
                        ->orWhereHas('marca', function ($m) use ($search) {
                            $m->where('nombre', 'LIKE', "%{$search}%");
                        });
                });
            });

            // 3. TIPO DE OFERTA
            $query->when($request->filled('nuevo'), function ($q) {
                return $q->where('year', '>=', 2026);
            });

            $query->when($request->filled('consignacion'), function ($q) {
                return $q->where('consignacion', 1);
            });

            // 4. AÑOS (Pills multiselección)
            $query->when($request->filled('years'), function ($q) use ($request) {
                return $q->whereIn('year', (array) $request->years);
            });

            // 5. KILOMETRAJE (Slider Dual)
            if ($request->filled('km_min') || $request->filled('km_max')) {
                $query->whereBetween('kilometraje', [
                    $request->input('km_min', 0),
                    $request->input('km_max', 500000)
                ]);
            }

            // 6. PRECIO (Slider Dual)
            if ($request->filled('price_min') || $request->filled('price_max')) {
                $query->whereBetween('precio', [
                    $request->input('price_min', 0),
                    $request->input('price_max', 3500000)
                ]);
            }

            // 7. FILTRO POR MARCAS (Usando id_marca)
            $query->when($request->filled('marcas'), function ($q) use ($request) {
                return $q->whereIn('id_marca', (array) $request->marcas);
            });

            // 8. FILTRO POR MODELOS 
            // Cambiado: Ahora filtra por la columna 'modelo' (string) en la tabla autos
            $query->when($request->filled('modelos'), function ($q) use ($request) {
                return $q->whereIn('modelo', (array) $request->modelos);
            });

            // 9. ORDENAMIENTO
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->latest('id_auto');
                    break;
            }

            // 10. EJECUCIÓN Y PAGINACIÓN
            $autos = $query->paginate(12);
            $autos->appends($request->all());

            if ($request->ajax()) {
                return view('catalog.partials._cars_grid', compact('autos'))->render();
            }

            return view('autos.autos', compact('autos', 'marcas'));

        } catch (Exception $e) {
            // Log del error para debug
            \Log::error("Error en el catálogo: " . $e->getMessage());

            // Retornamos la vista con un mensaje de error en lugar de redirigir para evitar bucles
            return view('autos.autos', [
                'autos' => collect(),
                'marcas' => $marcas,
                'errorMessage' => 'Lo sentimos, hubo un problema al cargar los vehículos.'
            ]);
        }
    }

    public function show($id)
    {
        try {

            $auto = Auto::with(['marca', 'imagenes', 'thumbnail'])->findOrFail($id);
            $marca = $auto->marca;
            $autosSugeridos = Auto::active()
                ->with(['marca', 'thumbnail'])
                ->where('id_auto', '!=', $id)
                ->inRandomOrder()
                ->limit(3)
                ->get();

            return view('autos.autoDetail', compact('auto', 'marca', 'autosSugeridos'));

        } catch (Exception $e) {
            \Log::error("Error al mostrar el auto ID {$id}: " . $e->getMessage());
            return redirect()->route('autos.index')->with('error', 'No se pudo cargar el detalle del auto.');
        }

    }
}