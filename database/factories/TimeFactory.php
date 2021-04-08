<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Time::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'minutes' => $this->faker->randomNumber('2'),
            'date' => Carbon::now(),
            'activity_id' => Activity::factory()->create()
        ];
    }
}
