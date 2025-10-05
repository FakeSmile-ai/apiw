<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Client;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
    
        $param = $this->route('client');
        $clientId = $param instanceof Client ? $param->id : $param;

        return [
            'name'    => ['sometimes','string','max:120'],
            'email'   => [
                'sometimes','email','max:150',
                Rule::unique('clients','email')->ignore($clientId),
            ],
            'phone'   => ['nullable','string','max:30'],
            'address' => ['nullable','string','max:255'],
        ];
    }
}
