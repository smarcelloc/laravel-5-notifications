<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isset($this->comment) ? $this->user()->can('comment-auth', $this->comment) : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:190'],
            'body' => ['required', 'string', 'min:3', 'max:1000'],
            'post_id' => ['required', 'integer', 'min:0','exists:post,id']
        ];
    }
}
