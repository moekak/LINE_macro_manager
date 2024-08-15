<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupMessageRequest extends FormRequest
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
        session()->flash("route_name", "group_message.edit");
        return [
            "group_message_id" => ["required", "integer", "exists:group_messages,id"],
            "group_message" => ["required"]
        ];
    }

    public function messages(): array
    {
        return[
            "group_message.required" => "メッセージは必須です。"
        ];
    }
}
