<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id','arrival_time','return_time','date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeIsArrival($query)
    {
        if ($this->where('employee_id',auth()->user()->employee->id)
        ->where('date',now()->toDateString('Y-m-d'))->first()) {
            return true;
        }else{
            return false;
        }

    }

    public function scopeIsReturn($query)
    {
        if ($this->where('employee_id',auth()->user()->employee->id)
        ->where('date',now()->toDateString('Y-m-d'))->whereNotNull('return_time')->first()) {
            return true;
        }else{
            return false;
        }
    }
}
