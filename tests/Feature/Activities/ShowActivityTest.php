<?php

namespace Tests\Feature\Activities;

use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

/**
 * Class ShowActivityTest.
 */
class ShowActivityTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserWhoIsNotLoggedInCannotSeeAActivity()
    {
        $routeAction = route('activities.show', 1);
        $this->get($routeAction)->assertRedirect('register');
    }

    /**
     * @test
     */
    public function anAuthorizedUserMaySeeAActivity()
    {
        $user = User::factory()->create();

        $activity = Activity::factory()->create([
            'created_by' => $user,
        ]);

        $routeAction = route('activities.show', $activity->id);
        $response = $this->actingAs($user)->get($routeAction);
        dd($response);
        $viewActivity = $response->original->getData()['activity'];
        dd($viewActivity);
        $this->assertEquals($binRangeSaved->getKey(), $binRange->getKey());
        $this->assertEquals($binRangeSaved->start_range, $binRange->start_range);
        $this->assertEquals($binRangeSaved->end_range, $binRange->end_range);
        $this->assertEquals($binRangeSaved->length, $binRange->length);
        $this->assertEquals($binRangeSaved->class, $binRange->class);
        $this->assertEquals($binRangeSaved->country_id, $binRange->country_id);
        $this->assertEquals($binRangeSaved->bank_id, $binRange->bank_id);
    }
}

