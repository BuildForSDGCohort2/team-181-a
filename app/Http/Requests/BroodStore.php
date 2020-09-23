<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BroodStore extends FormRequest
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
            'species' => ['required',],
            'gender' => ['required',  ],
            'breed' => ['nullable','integer','required_with:species'],
            'sellers_name' => ['required'],
            'number' => ['required','integer'],
            'hatch_date' => ['required'],
            'others'=>['required_without:species',]

        ];
    }
}
