<?php

namespace App\Traits;


use App\Models\Time;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasActivityRelationships
{
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }


    public function times(): HasMany
    {
        return $this->hasMany(Time::class);
    }
}
