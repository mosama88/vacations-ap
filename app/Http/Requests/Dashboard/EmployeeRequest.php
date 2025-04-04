<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $employeeId = $this->route()->employee->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:100|unique:employees,username,' . $employeeId,

            'password' => 'nullable|string|min:8', // تأكيد كلمة المرور
            'mobile' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15', // يجب أن يكون رقم موبايل صحيح
            'week_id' => 'required|exists:weeks,id', // تأكد من أن week_id موجود في جدول weeks
            'job_grade_id' => 'required|exists:job_grades,id', // تأكد من أن job_grade_id موجود في جدول job_grades
            'branch_id' => 'required|exists:branches,id', // تأكد من أن branch_id موجود في جدول branches
            'governorate_id' => 'required|exists:governorates,id', // تأكد من أن governorate_id موجود في جدول governorates
            'type' => 'required|in:0,1', // تأكد من أن governorate_id موجود في جدول governorates
            'gender' => 'required|in:0,1', // تأكد من أن governorate_id موجود في جدول governorates
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم الموظف مطلوب.',
            'name.string' => 'اسم الموظف يجب أن يكون نصًا.',
            'name.max' => 'اسم الموظف لا يمكن أن يتجاوز 255 حرفًا.',

            'username.required' => 'اسم المستخدم مطلوب.',
            'username.string' => 'اسم المستخدم يجب أن يكون نصًا.',
            'username.max' => 'اسم المستخدم لا يمكن أن يتجاوز 255 حرفًا.',
            'username.unique' => 'اسم المستخدم يجب أن يكون فريدًا.',

            'password.required' => 'كلمة المرور مطلوبة.',
            'password.string' => 'كلمة المرور يجب أن تكون نصًا.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
            'password.confirmed' => 'كلمة المرور غير متطابقة مع تأكيد كلمة المرور.',

            'mobile.required' => 'رقم الهاتف مطلوب.',
            'mobile.string' => 'رقم الهاتف يجب أن يكون نصًا.',
            'mobile.regex' => 'رقم الهاتف غير صحيح. يرجى إدخال رقم صحيح.',
            'mobile.min' => 'رقم الهاتف يجب أن يحتوي على 10 أرقام على الأقل.',
            'mobile.max' => 'رقم الهاتف لا يمكن أن يتجاوز 15 رقمًا.',

            'week_id.required' => 'الراحه الاسبوعية مطلوب.',
            'week_id.exists' => 'الراحه الاسبوعية غير موجود في قاعدة البيانات.',

            'job_grade_id.required' => 'الدرجه الوظيفية مطلوب.',
            'job_grade_id.exists' => 'الدرجه الوظيفية غير موجود في قاعدة البيانات.',

            'branch_id.required' => 'الفرع  مطلوب.',
            'branch_id.exists' => 'الفرع مطلوب غير موجود في قاعدة البيانات.',

            'gender.required' => 'نوع الجنس مطلوب.',

            'type.required' => 'نوع حساب الموظف مطلوب.',
            'roles.required' => 'صلاحيات الموظف مطلوبة.',

            'governorate_id.required' => 'المحافظة مطلوب.',
            'governorate_id.exists' => 'المحافظة غير موجود في قاعدة البيانات.',
        ];
    }
}
