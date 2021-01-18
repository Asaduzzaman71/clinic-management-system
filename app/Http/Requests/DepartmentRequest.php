<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $department = $this->route('department');
        return [

                'name' => 'required|max:255|unique:departments,name,'.$department,
                'description' =>'required|max:1000',
                'icon'=>'sometimes|file|image|max:5000',
                'status' => 'required|integer'
                
            ];
    }
}
