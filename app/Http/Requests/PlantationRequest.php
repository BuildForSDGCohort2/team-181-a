<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        #Spatie will handle auth
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
            'species' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'integer', ],
            'size' => ['required', 'integer',],
            'callibration' => ['required'],
            'planting_date' => ['required',],
        ];
        
    }
}
