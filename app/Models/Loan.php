<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Loan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'notes',
        'active',
        'employee_id',
        'item_id',
    ];

    #[Override]
    public function uniqueIds()
    {
        return ['uuid'];
    }

    #[Override]
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
