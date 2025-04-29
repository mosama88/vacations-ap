<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class JobTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $job_typesId = $this->route('jobType') ? $this->route('jobType')->id : null;


        return [
            'name' => 'required|unique:job_types,name,' . $job_typesId,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم نوع الوظيفه مطلوب.',
            'name.unique' => 'اسم نوع الوظيفه يجب أن يكون فريدًا.',
        ];
    }
}