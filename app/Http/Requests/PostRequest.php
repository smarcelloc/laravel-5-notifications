<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  isset($this->post) ? $this->user()->can('post-auth', $this->post) : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:190', 'unique:posts,title,' . ($this->post->id ?? '')],
            'body' => ['required', 'string', 'min:10', 'max:8000']
        ];
    }
}
