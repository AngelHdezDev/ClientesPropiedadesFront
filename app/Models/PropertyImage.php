<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'path',
        'is_main',
        'is_hero'
    ];

    // Casting para que is_main se comporte como booleano
    protected $casts = [
        'is_main' => 'boolean',
        'is_hero' => 'boolean',
    ];

    /**
     * Relación inversa: Una imagen pertenece a una propiedad.
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getUrlAttribute()
    {
        return config('app.admin_storage') . $this->path;
    }

    public function getThumbnailUrlAttribute()
    {
        // Si tienes una columna 'thumbnail_path' la usas, 
        // si no, que devuelva la misma URL original
        if (!empty($this->thumbnail_path)) {
            return config('app.admin_storage') . $this->thumbnail_path;
        }

        return $this->url; 
    }
  
}