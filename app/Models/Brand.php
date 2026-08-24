<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'active'
    ];

    public function uniqueIds()
    {
        return ['uuid'];
    }

        public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
