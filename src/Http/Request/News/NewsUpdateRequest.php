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
            'description' => 'required|string',
            'image' => 'image|max:2000',
            'video' => 'mimes:mp4|max:5000',
            'attachment' => 'mimes:docx,doc,pdf|max:5000',
        ];
    }
}
