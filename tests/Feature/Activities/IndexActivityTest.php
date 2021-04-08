<?php

namespace Tests\Feature\Activities;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class IndexActivityTest.
 */
class IndexActivityTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserWhoIsNotLoggedInCannotSeeTheListOfActivities()
    {
        $routeAction = route('activities.index');
        $this->get($routeAction)->assertRedirect('register');
    }

    /**
     * @test
     */
    public function anAuthenticatedUserCannotSeeActivitiesThatAreNotTheirs()
    {
        $user = User::factory()->create();

        $activity = Activity::factory()->create();

        $routeAction = route('activities.index');
        $response = $this->actingAs($user)->get($routeAction)->assertOk();

        $viewActivities = $response->original->getData()['activities'];

        $this->assertFalse($viewActivities->contains($activity));
    }


    /**
     * @test
     */
    public function anAuthorizedUserMayListActivities()
    {
        $user = User::factory()->create();

        $activityA = Activity::factory()->create(['created_by' => $user]);

        $activityB = Activity::factory()->create(['created_by' => $user]);

        $routeAction = route('activities.index');
        $response = $this->actingAs($user)->get($routeAction)->assertOk();

        $viewActivities = $response->original->getData()['activities'];

        $this->assertTrue($viewActivities->contains($activityA));
        $this->assertTrue($viewActivities->contains($activityB));
    }

}

