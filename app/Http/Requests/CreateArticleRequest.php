<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

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
            'title'=>'required|string',
            'cont'=>'required|string',
            'image'=> 'image',
            'tags'=>'required'
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
            'tags.required'=>'Pridelenie tagu clanku je povinne.',
            'title.required'=>'Nazov clanku je povinny.',
            'title.string'=>'Nazov clanku musi byt postupnost znakov.',
            'cont.required'=>'Obsah clanku je povinny.',
            'cont.string'=>'Obsah clanku musi byt postupnost znakov.',
            'image.image'=>'Obrazok clanku musi byt obrazok.'
        ];
    }
}
