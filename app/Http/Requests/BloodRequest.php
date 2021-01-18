<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodRequest extends FormRequest
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
       
        $blood = $this->route('blood');
        return [

                'blood_group' => 'required|max:255|unique:bloods,blood_group,'.$blood,
                'description' =>'required|max:1000',
                'status' => 'required|integer'
              ];
    }
}
