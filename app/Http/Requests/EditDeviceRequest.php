<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class EditDeviceRequest extends FormRequest
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

        $id = $this->route("id");
        session()->flash('route_name', 'device.edit');

        return [
            "device_id" => ["required", "integer", "exists:devices,id"],
            "account_name" => ["required", "string", "unique:devices,account_name," . $id],
            "device_name" => ["required", "string"],
            "uid" => ["required", "string", "unique:devices,uid," . $id]
        ];
    }

    public function messages():array
    {
        return[
            "account_name.required" => "アカウント名は必須です。",
            "account_name.unique" => "このアカウント名は既に使われています。",
            "device_name.required" => "デバイス名は必須です",
            "uid.required" => "uidは必須です",
            "uid.unique" => "このuidは既に使われています。",
        ];
    }
}
