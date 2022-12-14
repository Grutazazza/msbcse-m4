<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTelegramCommandValidationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'command'=>[
                'required',
                Rule::unique('telegram_commands','command')->ignore($this->route()->parameter('telegramCommand'))
            ],
            'context'=>'required'
        ];
    }
}
