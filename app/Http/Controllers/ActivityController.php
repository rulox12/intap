<?php

namespace App\Http\Controllers;

use App\Domain\Actions\CreateOrUpdateActivityAction;
use App\Http\Requests\StoreActivityRequest;
use App\Models\Activity;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ActivityController extends Controller
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

        $activities = Activity::forIndex()->paginate();

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * @param StoreActivityRequest $request
     * @return RedirectResponse
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $activity = CreateOrUpdateActivityAction::execute($request, new Activity());

        return redirect()->route('activities.show', $activity)
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
