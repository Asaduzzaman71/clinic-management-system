<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'department_id'=>'required|integer',
            'doctor_id' => 'required|integer',
            'day_id'=>'required|integer',
            'total_patient'=>'required|integer',  
            'starting_time'=>'required', 
            'ending_time'=>'required',
            'status' => 'required|integer'
        ];
    }
}
