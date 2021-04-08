<?php

namespace App\Rules;

use App\Models\Activity;
use Illuminate\Contracts\Validation\Rule;

class MinuteValidations implements Rule
{

    Const MAX_MINUTES = 480;

    /**
     * @var string
     */
    private $activityId;

    public function __construct(string $activityId)
    {
        $this->activityId = $activityId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return (intval($value) + Activity::find($this->activityId)->times->sum($attribute)) <= self::MAX_MINUTES;
    }

    public function message(): string
    {
        return __('Error recording times, exceeds 480 minutes');
    }
}
