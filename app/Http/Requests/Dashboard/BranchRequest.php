<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        $branchId = $this->route('branch') ? $this->route('branch')->id : null;
        return [
            'name' => 'required|unique:branches,name,' . $branchId,
            'governorate_id' => 'required|exists:governorates,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'اسم الفرع مطلوب.',
            'name.unique' => 'اسم الفرع يجب أن يكون فريدًا.',
            'governorate_id.required' => 'محافظة الفرع مطلوبة.',
            'governorate_id.exists' => 'المحافظة المحددة غير موجودة في النظام.',
        ];
    }
}