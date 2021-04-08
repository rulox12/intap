<?php

namespace App\Models;

use App\Traits\HasActivityRelationships;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * @property int $id
 * @property string $description
 */
class Activity extends Model
{
    use HasFactory;
    use HasActivityRelationships;

    public function scopeForIndex(Builder $query): Builder
    {
        return $query->where('created_by' , auth()->user()->id);
    }
}
