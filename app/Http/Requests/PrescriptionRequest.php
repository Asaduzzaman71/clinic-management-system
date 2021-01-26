<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
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
            'patient_id'=>'required|integer',
            'doctor_id'=>'required|integer',
            'case_history'=>'required|max:1000',
            'medication'=>'required|max:1000',
            'note' =>'required|max:1000',
            'status' => 'required|integer'
        ];
    }
}
