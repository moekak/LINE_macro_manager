<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            "name"=> ["required", "string", "max:50", "unique:users,name"],
            "password"=>["required", "string", "min:6"]
        ];
    }

    public function messages():array
    {
        return[
            "name.required" => "ユーザーネームは必須です。",
            "name.unique" => "このユーザーネームは既に使われています。",
            "password.required" => "パスワードは必須です",
            "password.min" => "パスワードは6文字以上に設定してください"
        ];
    }
}
