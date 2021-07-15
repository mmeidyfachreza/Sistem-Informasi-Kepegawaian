<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];

    public function employees()
    {
        $this->hasMany(Employee::class);
    }
}
