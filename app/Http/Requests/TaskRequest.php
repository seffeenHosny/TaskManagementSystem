<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends AbstractFormRequest
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
        return [
            'user_id'=>'required|exists:users,id',
            'title'=>'required|min:3|max:270',
            'description'=>'nullable',
            'due_date'=>'required|date',
            'status'=>'required|in:Not Started,In Progress,Completed',
            'priority'=>'required|in:Low,Medium,High',
        ];
    }
}
