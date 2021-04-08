<?php

namespace App\Domain\Times;

use App\Models\Activity;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateTimeAction
{
    public static function execute(Request $request, Time $time): Time
    {
        $time->minutes = $request->input('minutes');
        $time->date = $request->input('date');
        $time->activity_id = $request->input('activity_id');
        $time->created_by = Auth::user()->id;

        $time->save();

        return $time;
    }
}
