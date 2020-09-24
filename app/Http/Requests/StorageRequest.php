<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageRequest extends FormRequest
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
            'sacks'=>['required','integer'],
            'sell'=>['nullable'],
            'price'=>['required_with:sell','integer'],
            'sell_all'=>['nullable'],
            'amount'=>['nullable','integer'],
            'harvest_transport'=>['nullable']           
        ];
    }
}
