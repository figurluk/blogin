<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAdminRequest extends Request
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'=>'Meno musí byť vyplnené.',
            'name.max'=>'Meno môže mať najviac 255 znakov.',
            'name.string'=>'Meno musí byť postupnosť znakov.',
            'surname.string'=>'Priezvisko musí byť postupnosť znakov.',
            'surname.required'=>'Priezvisko musí byť vyplnené.',
            'surname.max'=>'Priezvisko môže mať najviac 255 znakov.',
            'email.required'=>'Email musí byť vyplnený.',
            'email.email'=>'Email musí byť platná emailová adresa.',
            'email.unique'=>'Zadaný email už je registrovaný.',
            'email.max'=>'Email môže mať najviac 255 znakov.',
        ];
    }
}
