<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "title"      => "required|max:255",
            "contact"    => "required",
            "email"      => "required|email",
            "address"    => "required|max:1000",
            "facebook"   => "nullable",
            "twitter"    => "nullable",
            "instagram"  => "nullable",
            "google"     => "nullable",
            "youtube"    => "nullable",
            "footer_text"=>"required",
            "footer_year"=>"required",
            "favicon"    => "mimes:png,ico,svg",
            "logo"       => "mimes:png,jpg,jpeg",
            'sliders.*'  => 'sometimes|file|image',
            
        ];
    }
}
