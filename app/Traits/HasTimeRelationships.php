<?php

namespace App\Traits;


use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTimeRelationships
{
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
