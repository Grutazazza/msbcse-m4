<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditParametrsValidationRequest extends FormRequest
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
     *правила валидации
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>[
                'required',
                Rule::unique('telegram_settings','name')->ignore($this->route('telegramSetting'))
            ],
            'val'=>'required'
        ];
    }
    //русские ошибки
    public function messages()
    {
        return parent::messages()+[
                'name.required'=>'Поле обязательно для заполнения именем',
                'val.required'=>'Поле обязательно для заполнения значением',
                'name.unique'=>'Поле обязательно должно быть уникально',
            ]; // TODO: Change the autogenerated stub
    }
}
