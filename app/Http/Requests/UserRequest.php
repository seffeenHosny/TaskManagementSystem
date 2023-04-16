<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends AbstractFormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('user')->id ?? null;
        return [
            'name'=>'required|string|min:3|max:50',
            'email'=>"required|unique:users,email,$id",
            'password'=>[requiredIf($id) , 'min:6' , 'confirmed'],
            'role_id'=>'required|exists:roles,id'
        ];
    }
}
