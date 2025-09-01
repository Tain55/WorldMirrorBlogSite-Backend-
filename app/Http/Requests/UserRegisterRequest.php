<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
   //defining who can authorize this api
    public function authorize(): bool
    {
        return true;
    }

   //the validation rules
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
}

// this is used for from validation and 
// setting rules for the authorized peopel