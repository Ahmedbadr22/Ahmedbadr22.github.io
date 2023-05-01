<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMeetingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'meeting_title' => ['required', 'string', 'max:255'],
            'meeting_description' => ['required', 'string', 'max:255'],
            'doctor_email' => ['required', 'email'],
            'patient_email' => ['required', 'email'],
            'start_time' => ['required','date_format:Y-m-d H:i:s'],
        ];
    }
}
