<?php

namespace App\Domain\Actions;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateActivityAction
{
    public static function execute(Request $request, Activity $activity): Activity
    {
        $activity->description = $request->input('description');
        $activity->created_by = Auth::user()->id;

        $activity->save();

        return $activity;
    }
}
