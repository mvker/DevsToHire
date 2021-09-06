<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ModifyDashboardSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => [
                'sometimes',
                'nullable',
                'string',
                'max:60'
            ],
            'lastname' => [
                'sometimes',
                'nullable',
                'string',
                'max:60',
            ],
            'email' => [
                'sometimes',
                'nullable',
                'email'
            ],
            'sliderHourlyRate' => [
                'sometimes',
                'integer',
                'min:1',
                'max:150'
            ],
            'skills' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],
            'category' => [
                'sometimes',
                'integer'
            ],
            'country' => [
                'sometimes',
                'integer',
            ],
            'description' => [
                'sometimes',
                'string',
                'max:500'
            ],
            'currentPassword' => [
                'sometimes',
                'required_with:newPassword,newPasswordConf',
            ],
            'newPassword' => [
                'sometimes',
                'required_with:newPasswordConf',
            ],
            'newPasswordConf' => [
                'sometimes',
                'same:newPassword'
            ],
            'attachmentUpload' => [
                'sometimes',
                'mimes:pdf,docx',
                'max:20000'
            ]
        ];
    }
}
