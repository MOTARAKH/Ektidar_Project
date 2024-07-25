<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleRecepetionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'side' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'descriptions' => 'array',
            'descriptions.*' => 'nullable|string',
            'finished' => 'integer'
        ];
    }
}
