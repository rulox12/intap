<?php

namespace App\Models;

use App\Traits\HasTimeRelationships;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Time
 * @property int $id
 * @property int $minutes
 * @property string $date
 * @property int $activity_id
 */
class Time extends Model
{
    use HasFactory;
    use HasTimeRelationships;


    public function scopeForIndex(Builder $query){
        return $query->where('created_by' , auth()->user()->id);
    }
}
