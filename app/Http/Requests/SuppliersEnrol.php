<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuppliersEnrol extends FormRequest
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
            // 'specialty' => ['required'],
            'email' => ['required', 'string', 'max:30','unique:App\Supplier,email'],
            'kra' => ['required'],
            'agree' => ['required'],
            'location'=>['string','required'],
            // here one must select one hardware or Agro.. or both
            'hardware'=>[],
            'agrovet'=>[],
            'transport'=>[]
            
        ];
    }
}
