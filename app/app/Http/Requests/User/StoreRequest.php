<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'=>'required',
            'surname'=>'required',
            'phone_number'=>'required|unique:users,phone_number',
            'personnel_code'=>'required|unique:users,personnel_code',
//            'profile_picture'=>'required|file|mimes:jpg,png',
            'password' => 'confirmed|min:6|max:255',
        ];
    }
}
