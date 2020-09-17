<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmersRequest extends FormRequest
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
            'phone_number' => ['required', 'string', 'max:10'],
            'id_number' => ['required', 'string', 'max:10'],
            // 'specialty' => ['required'],
            'email' => ['required', 'string', 'max:30','unique:App\Farmer,email'],
            'agr' => ['required'],
            'location'=>['string','required'],
            // here one must select one hardware or Agro.. or both
            'transport'=>[],
            'fields'=>['required'],
            'size'=>['required'],
            'callibration'=>['required'],
            'password'=>['required'],
            'conf_password'=>['required','same:password']
            
        ];
    }
}
