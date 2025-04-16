<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
        return [
            'leave_code' => 'nullable|integer|unique:leaves,leave_code',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_type' => 'required|in:1,2,3,4',
            'leave_status' => 'nullable|in:1,2,3',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'تاريخ بداية الاجازه مطلوب',
            'start_date.date' => 'تاريخ بداية الاجازه يجب أن يكون تاريخ صحيح',
            'start_date.after_or_equal' => 'تاريخ بداية الاجازه يجب أن يكون اليوم أو بعده',

            'end_date.required' => 'تاريخ نهاية الاجازه مطلوب',
            'end_date.date' => 'تاريخ نهاية الاجازه يجب أن يكون تاريخ صحيح',
            'end_date.after_or_equal' => 'تاريخ نهاية الاجازه يجب أن يكون بعد أو يساوى تاريخ بداية الاجازه',

            'leave_type.required' => 'نوع الإجازة مطلوب',
            'leave_type.in' => 'نوع الإجازة غير صالح',

            'leave_status.in' => 'حالة الإجازة غير صالحة',

            'description.string' => 'الوصف يجب أن يكون نصًا',
            'description.max' => 'الوصف يجب ألا يتجاوز 500 حرفًا',

        ];
    }
}