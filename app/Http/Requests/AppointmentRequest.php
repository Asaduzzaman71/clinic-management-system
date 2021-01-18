<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class AppointmentRequest extends FormRequest
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
            'patient_id'=>'Nullable|integer',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'mobile'=>'required|integer',
            'department_id'=>'required|integer',
            'doctor_id' => 'required|integer',
            'date'=>'required|after:yesterday',
            'message' =>'required|max:1000', 
            'status' => 'required|integer'
        ];
    }
}
