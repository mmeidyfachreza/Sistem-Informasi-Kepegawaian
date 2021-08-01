<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'birth_date',
        'birth_place',
        'gender',
        'employee_status',
        'marital_status',
        'address',
        'religion',
        'education',
        'major',
        'entry_year',
        'section_id',
        'job_title_id',
        'photo',
    ];

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }


    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function scopeSearchByNIP($query,$value)
    {
        return $query->where('nip','like','%'.$value.'%');
    }

    public function scopeDashboardSearch($querry,$request)
    {
        return $querry->where('nip','like','%'.$request['nip'].'%');
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }
    }
}
