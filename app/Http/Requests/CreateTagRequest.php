<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Requests;

/**
 * Class CreateTagRequest
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Requests
 */
class CreateTagRequest extends Request
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
            'name' => 'required|string|unique:tags,deleted_at,NULL',
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
            'name.required' => 'Názov tagu je povinný.',
            'name.string' => 'Názov tagu musí byť postupnosť znakov.',
            'name.unique' => 'Názov tagu musí byť unikátne.',
        ];
    }
}
