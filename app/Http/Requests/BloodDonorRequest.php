<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodDonorRequest extends FormRequest
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
        $bloodDonor = $this->route('bloodDonor');
        return [
            
            'name' => 'required|max:255',
            'email' => 'required|email|unique:blood_donors,email,'.$bloodDonor,
            'address'=>'nullable|max:255',
            'mobile'=>'required|unique:blood_donors,mobile,'.$bloodDonor,
            'gender'=>'required',
            'blood_id'=>'required|integer', 
            'age'=>'required|integer', 
            'last_donation'=>'required',
           
           
        ];
    }
}
