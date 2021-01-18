<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $doctor = $this->route('doctor');
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:doctors,email,'.$doctor,
            'image'=>'sometimes|file|image|max:5000',
            'password'=>'password|required',
            'address'=>'nullable|max:255',
            'mobile'=>'required|integer',
            'department_id'=>'required|integer',
            'profile'=>'required|max:1000',
            'status' => 'required|integer'
        ];
    }
}
