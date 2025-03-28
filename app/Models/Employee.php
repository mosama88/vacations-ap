<?php

namespace App\Models;

use App\Enum\EmployeeType;
use Spatie\Image\Enums\Fit;
use App\Enum\EmployeeGender;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements HasMedia
{
    use HasFactory, HasSlug, Notifiable, InteractsWithMedia;

    protected $table = 'employees';

    protected $fillable = [
        'employee_code',
        'name',
        'slug',
        'username',
        'password',
        'mobile',
        'week_id',
        'job_grade_id',
        'branch_id',
        'governorate_id',
        'created_by',
        'updated_by',
    ];


    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }



    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }

    public function jobGrade()
    {
        return $this->belongsTo(JobGrade::class, 'job_grade_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function leaveBalance()
    {
        return $this->hasOne(LeaveBalance::class);
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $casts = [
        'gender' => EmployeeGender::class,
        'type' => EmployeeType::class,
    ];
}