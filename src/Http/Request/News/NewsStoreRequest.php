<?php

namespace OliveMedia\OliveMediaNews\Http\Request\News;

use Illuminate\Foundation\Http\FormRequest;


class NewsStoreRequest extends FormRequest
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
            'description' => 'required|string',
            'image' => 'nullable|image|max:2000',
            'video' => 'nullable|mimes:mp4|max:5000',
            'attachment' => 'nullable|mimes:docx,doc,pdf|max:5000',
        ];
    }
}
