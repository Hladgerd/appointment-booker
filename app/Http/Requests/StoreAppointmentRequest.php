<?php

namespace App\Http\Requests;

use App\Rules\WithinBusinessTime;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'clientName' => ['required', 'string', 'min:4', 'max:2000'],
            'start' => ['bail', 'required', 'date', 'after:yesterday', new WithinBusinessTime()],
            'end' => ['bail', 'required', 'date', 'after:start'],
        ];
    }
}
