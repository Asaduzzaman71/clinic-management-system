<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
        $patient = $this->route('patient');
        return [
            'blood_id'=>'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:patients,email,'.$patient,
            'password'=>'required',
            'birthdate'=>'required',
            'address'=>'nullable|max:255',
            'mobile'=>'required|integer',
            'gender'=>'required',
            'age'=>'required|integer',  
            'image'=>'sometimes|file|image|max:5000', 
            'status' => 'required|integer'
        ];
    }
}
