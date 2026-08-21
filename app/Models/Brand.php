<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'activo'
    ];

    public function uniqueIds()
    {
        return ['uuid'];
    }

        public function getRouteKeyName(): string
    {
        return 'uuid';
    }

}
