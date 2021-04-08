<?php

namespace Tests\Feature\Activities;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class StoreActivityTest.
 */
class StoreActivityTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserWhoIsNotLoggedInCannotStoreAActivity()
    {
        $data = Activity::factory()->make();

        $this->post(route('activities.store'), $data->toArray())->assertStatus(403);
    }

    /**
     * @test
     */
    public function anAuthorizedUserMayStoreAActivity()
    {
        $user = User::factory()->create();

        $data = Activity::factory()->make();

        $routeAction = route('activities.store');
        $this->actingAs($user)->post($routeAction, $data->toArray())->assertRedirect()->assertSessionHasNoErrors();

        $activity = Activity::first();

        $this->assertEquals($data->description, $activity->description);
        $this->assertEquals($user->id, $activity->created_by);
    }
}

