<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required',  ],
            'species' => ['required',],
            'breed_id' => ['required','integer'],
            'mothers_name' => ['required'],
            'weight' => ['required'],
            'birthday'=>['nullable'],
            'approx_age'=>['required_without:birthday'],
            'approximation'=>['required_with:approx_age'],
            'health_status'=>['nullable'],
            'pregnancy_status'=>['nullable']

        ];
    }
}
