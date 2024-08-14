<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationMessageRequest extends FormRequest
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
        session()->flash("route_name", "message.edit");
        return [
            "message_id" => ["required", "integer", "exists:registration_messages,id"],
            "message" => ["required"]
        ];
    }

    public function messages(): array
    {
        return[
            "message.required" => "メッセージは必須です。"
        ];
    }
}
