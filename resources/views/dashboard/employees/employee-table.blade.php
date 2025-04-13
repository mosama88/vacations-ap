@php
    use App\Enum\EmployeeStatus;
@endphp
<div class="card-body p-0">

    <div class="row col-12 my-2">
        <div class="form-group col-4">
            <label for="exampleInputName">بحث باسم الموظف أو أسم المستخدم أو كود الموظف</label>
            <input type="text" wire:model.live="emp_search" class="form-control" id="exampleInputName"
                placeholder="أدخل موظف جديد">
        </div>
        <div class="form-group col-4">
            <label for="exampleSelectBorder">بحث بنوع الجنس</code></label>
            <select wire:model.live="gender_search" class="custom-select form-control-border" id="exampleSelectBorder">
                <option value="">-- أختر النوع --</option>
                <option value="{{ App\Enum\EmployeeGender::Male }}">
                    ذكر</option>
                <option value="{{ App\Enum\EmployeeGender::Female }}">
                    انثى</option>
            </select>
        </div>

        <div class="form-group col-4">
            <label for="exampleSelectBorder">بحث بالراحه الاسبوعية</code></label>
            <select name="week_id" wire:model.live="week_search" class="custom-select form-control-border"
                style="width: 100%;" id="exampleSelectBorder">
                <option value="">-- أختر الراحه الاسبوعية --</option>
                @forelse ($other['weeks'] as $week)
                    <option @if (old('week_id') == $week->id) selected @endif value="{{ $week->id }}">
                        {{ $week->name }}</option>
                @empty
                    عفوآ لا توجد بيانات!
                @endforelse
            </select>
        </div>

        <div class="form-group col-4">
            <label for="exampleSelectBorder">بحث بالمحافظة</label>
            <select wire:model.live="mohafza_search" class="custom-select form-control-border">
                <option value="">-- أختر المحافظة --</option>
                @forelse ($other['governorates'] as $governorate)
                    <option @if (old('governorate_id') == $governorate->id) selected @endif value="{{ $governorate->id }}">
                        {{ $governorate->name }}</option>
                @empty
                    عفوآ لا توجد بيانات!
                @endforelse
            </select>
        </div>

        <div class="form-group col-4">
            <label for="exampleSelectBorder">بحث بالفرع</label>
            <select wire:model.live="fara_search" class="custom-select form-control-border">
                <option value="">-- أختر الفرع --</option>
                @forelse ($other['branches'] as $branche)
                    <option @if (old('branch_id') == $branche->id) selected @endif value="{{ $branche->id }}">
                        {{ $branche->name }}</option>
                @empty
                    عفوآ لا توجد بيانات!
                @endforelse
            </select>
        </div>

        <div class="form-group col-3">
            <label></label>
            <div class="mg-t-10">
                @if (empty($emp_search) && empty($fara_search) && empty($gender_search) && empty($mohafza_search) && empty($week_search))
                    <div class="mg-t-10">
                        <button class="btn  btn-light btn-block" disabled>أمسح</button>
                    </div>
                @else
                    <div class="mg-t-10">
                        <button wire:click.prevent="clear()" class="btn btn-primary btn-block">أمسح</button>
                    </div>
                @endif

            </div>

        </div>
        <table class="table table-head-fixed text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>كود الموظف</th>
                    <th>أسم الموظف</th>
                    <th>أسم المستخدم</th>
                    <th>الموبايل</th>
                    <th>الراحه</th>
                    <th>المحافظة</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $info)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $info->employee_code }}</td>
                        <td>{{ $info->name }}</td>
                        <td>{{ $info->username }}</td>
                        <td>{{ $info->mobile }}</td>
                        <td>{{ $info->week->name }}</td>
                        <td>{{ $info->governorate->name }}</td>
                        <td>{{ $info->status }}</td>
                        <td>
                            @if ($info->status == EmployeeStatus::Active)
                                <span class="badge bg-success">نشط</span>
                            @else
                                <span class="badge bg-danger">غير نشط</span>
                            @endif
                        </td>

                        <td class="project-actions">
                            @include('dashboard.partials.action', [
                                'name' => 'employees',
                                'name_id' => $info,
                            ])

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-primary" role="alert">
                        عفوآ لاتوجد بيانات
                        !
                    </div>
                @endforelse
            </tbody>
        </table>

        <div class="col-md-12">
            {{ $data->links() }}

        </div>
    </div>
</div>
