<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'sometimes|nullable|image|max:2048',
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'division_id' => 'sometimes|exists:divisions,id',
            'position' => 'sometimes|string|max:255',
        ];
    }
}
