<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Activity
 * @property int $id
 * @property string $description
 */
class Activity extends Model
{
    use HasFactory;

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function scopeForIndex(Builder $query){
        return $query->where('created_by' , auth()->user()->id);
    }
}
