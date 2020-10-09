<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStore extends FormRequest
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
            'name'=> ['string','required'],

            'phone_number' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'max:30','unique:App\Farmer,email'],
            'location'=>['string','required'],
            'password'=>['required'],
            'conf_password'=>['required','same:password']
        ];
    }
}
