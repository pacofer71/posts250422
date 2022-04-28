<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user_id==auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'=>['required', 'string', 'min:3', 'max:25', Rule::unique('posts')->ignore($this->post)],
            'contenido'=>['required', 'string', 'min:5', 'max:250'],
            'user_id'=>['required', 'integer', 'exists:users,id'],
            'img'=>['nullable', 'image', 'max:2048'],
            'status'=>['required', Rule::in(['PUBLICADO', 'BORRADOR'])]
        ];
    }
}
