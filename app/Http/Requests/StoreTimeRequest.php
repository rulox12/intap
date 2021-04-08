<?php

namespace App\Http\Requests;

use App\Rules\MinuteValidations;
use Illuminate\Foundation\Http\FormRequest;

class StoreTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'activity_id' => 'bail|required|exists:activities,id',
            'minutes' => ['required', new MinuteValidations($this->input('activity_id'))],
            'date' => 'required',
        ];
    }
}
