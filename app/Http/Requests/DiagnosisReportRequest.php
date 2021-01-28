<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosisReportRequest extends FormRequest
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
            'test_id' => 'required|integer',
            'document_type_id' => 'required|integer',
            'document'=>'required|mimes:png,gif,jpeg,txt,pdf,doc|max:5000',
            'description' =>'required|max:1000',
            
        ];
    }
}
