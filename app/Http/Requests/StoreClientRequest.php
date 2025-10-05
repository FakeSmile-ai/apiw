<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'    => ['required','string','max:120'],
            'email'   => ['required','email','max:150','unique:clients,email'],
            'phone'   => ['nullable','string','max:30'],
            'address' => ['nullable','string','max:255'],
        ];
    }
}
