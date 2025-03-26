<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LeaveBalanceRequest extends FormRequest
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
            'employee_id' => 'required|exists:employees,id',
            'total_days' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب تحديد الموظف.',
            'employee_id.exists' => 'الموظف المحدد غير موجود.',
            'total_days.required' => 'يجب تحديد إجمالي الأيام.',
            'total_days.integer' => 'إجمالي الأيام يجب أن يكون عدد صحيح.',
            'total_days.min' => 'إجمالي الأيام يجب أن يكون أكبر من أو يساوي 0.',
        ];
    }
}
