<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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

        $admin = $this->route('admin');
        // //dd($admin);
        
        return [
            'role_id'=>'required',
            'name'=>'required|min:3',
            'email' => 'required|email|unique:admins,email,'.$admin,
            'phone'=>'required',
            'password'=>'nullable',
            'address'=>'required',
            'image'=>'sometimes|file|image|max:5000',
            'status' => 'required|integer'
            
        ];
    }
}
