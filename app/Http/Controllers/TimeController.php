<?php

namespace App\Http\Controllers;

use App\Domain\Times\CreateOrUpdateTimeAction;
use App\Http\Requests\StoreTimeRequest;
use App\Models\Activity;
use App\Models\Time;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $times = Time::forIndex()->paginate();

        return view('admin.times.index', compact('times'));
    }

    /**
     * @param StoreTimeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTimeRequest $request): RedirectResponse
    {
        CreateOrUpdateTimeAction::execute($request, new Time());

        return redirect()->route('activities.show', $request->input('activity_id'))
            ->with('success', __('Record created successfully'));
    }

    /**
     * @param Activity $activity
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Activity $activity)
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        return view('admin.activities.show', compact('activity'));
    }
}
