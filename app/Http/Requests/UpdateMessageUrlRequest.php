<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageUrlRequest extends FormRequest
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
        session()->flash("route_name", "url.edit");
        return [
            "url_id" => ["required", "integer", "exists:message_urls,id"],
            "url" => ["required", "url"]
        ];
    }

    public function messages(): array
    {
        return[
            "url.required" => "URLは必須です。",
            "url.url" => "URLの形式が正しくありません。",
        ];
    }
}
