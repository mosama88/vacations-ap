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
            'finance_calendar_id' => 'required|exists:finance_calendars,id',
            'total_days' => 'required|integer|min:0',
            'used_days' => 'required|integer|min:0|max:',
            'remaining_days' => 'required|integer|min:0|max:',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب تحديد الموظف.',
            'employee_id.exists' => 'الموظف المحدد غير موجود.',
            'finance_calendar_id.required' => 'يجب تحديد التقويم المالي.',
            'finance_calendar_id.exists' => 'التقويم المالي المحدد غير موجود.',
            'total_days.required' => 'يجب تحديد إجمالي الأيام.',
            'total_days.integer' => 'إجمالي الأيام يجب أن يكون عدد صحيح.',
            'total_days.min' => 'إجمالي الأيام يجب أن يكون أكبر من أو يساوي 0.',
            'used_days.required' => 'يجب تحديد الأيام المستخدمة.',
            'used_days.integer' => 'الأيام المستخدمة يجب أن تكون عدد صحيح.',
            'used_days.min' => 'الأيام المستخدمة يجب أن تكون أكبر من أو تساوي 0.',
            'used_days.max' => 'الأيام المستخدمة لا يمكن أن تتجاوز إجمالي الأيام.',
            'remaining_days.required' => 'يجب تحديد الأيام المتبقية.',
            'remaining_days.integer' => 'الأيام المتبقية يجب أن تكون عدد صحيح.',
            'remaining_days.min' => 'الأيام المتبقية يجب أن تكون أكبر من أو تساوي 0.',
            'remaining_days.max' => 'الأيام المتبقية لا يمكن أن تتجاوز الفرق بين إجمالي الأيام والأيام المستخدمة.',
        ];
    }
}
