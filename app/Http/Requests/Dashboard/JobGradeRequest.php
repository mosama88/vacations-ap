<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class JobGradeRequest extends FormRequest
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
        $job_gradesId = $this->route()->job_grades->id ?? null;

        return [
            'name' => 'required|unique:job_grades,name,' . $job_gradesId,
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الدرجه الوظيفية مطلوب.',
            'name.unique' => 'اسم الدرجه الوظيفية يجب أن يكون فريدًا.',
        ];
    }
}
