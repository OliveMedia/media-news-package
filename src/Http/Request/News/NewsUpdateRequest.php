<?php

namespace OliveMedia\OliveMediaNews\Http\Request\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class NewsUpdateRequest extends FormRequest
{
    protected $errorBag = 'consoleUpdateNews';
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
    public function rules(Request $request)
    {
        $request->session()->flash('news_id', $request->get('news_id'));
        return [
            'title' => 'required|string',
            'description' => 'nullable|string|required_without_all:image,video',
            'image' => 'nullable|image|max:2000|required_without_all:description,video',
            'video' => 'nullable|mimes:mp4|max:500000|required_without_all:image,description',
            'attachment' => 'nullable|mimes:docx,doc,pdf|max:5000',
        ];
    }
}
