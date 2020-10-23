<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfEnrols extends FormRequest
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
                'id_number' => ['required', 'string', 'max:6','unique:App\Proffesional,id_number'],
                'phone_number' => ['required', 'string', 'max:12','unique:App\Proffesional,phone','unique:App\User,phone_number'],
                'specialty' => ['required'],
                'email' => ['required', 'string', 'max:30','unique:App\Proffesional,email','unique:App\User,email'],
                'exp' => ['required', 'integer'],
                'file' => ['required'],
                'agre' => ['required'],
                'location'=>['required']
        ];
    }
}
