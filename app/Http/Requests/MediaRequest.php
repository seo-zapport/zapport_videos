<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'file_name'  =>  'required|mimes:mp4',
            'category_id'   =>  'required',
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
            'file_name.required'  =>  'File name is required',
            'file_name.mimes'  =>  'File must be a file of type: mp4',
            'category_id.required'  =>  'Select at least One Category',
        ];
    }
}
