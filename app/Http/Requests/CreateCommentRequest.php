<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateCommentRequest
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Http\Requests
 */
class CreateCommentRequest extends Request
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
            'cont'=>'required|string',
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
            'cont.required'=>'Obsah komentáru je povinný.',
            'cont.string'=>'Obsah komentáru musí byť postupnosť znakov.',
        ];
    }
}
