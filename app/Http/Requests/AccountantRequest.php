<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountantRequest extends FormRequest
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
        $accountant = $this->route('accountant');

        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:accountants,email,'.$accountant,
            'password'=>'required',
            'address'=>'nullable|max:255',
            'mobile'=>'required|integer', 
            'image'=>'sometimes|file|image|max:5000', 
            'status' => 'required|integer'
        ];
    }
}
