<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleMediaRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'MediaOutlet' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'ParticipatingParties' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'descriptions' => 'array',
            'descriptions.*' => 'nullable|string',
            'finished' => 'integer'
        ];
    }
}
