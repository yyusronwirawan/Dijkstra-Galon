<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    // protected $redirectRoute = 'users.create';
    // protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Nama tidak boleh kosong'
    //     ];
    // }
}
