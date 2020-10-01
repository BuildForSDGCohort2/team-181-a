<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class H_SchedulerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'scheduled_date'=>['required'],
            'schedule_transport'=>['nullable']
        ];
    }
}
