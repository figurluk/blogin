<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateArticleRequest
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Requests
 */
class CreateArticleRequest extends Request
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
            'title' => 'required|string',
            'cont' => 'required|string',
            'image' => 'image',
            'tags' => 'required'
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
            'tags.required' => 'Pridelenie tagu článku je povinné.',
            'title.required' => 'Názov článku je povinný.',
            'title.string' => 'Nazov článku musí byť postupnosť znakov.',
            'cont.required' => 'Obsah článku je povinny.',
            'cont.string' => 'Obsah článku musí byť postupnosť znakov.',
            'image.image' => 'Obrázok článku musí byť obrázok.'
        ];
    }
}
