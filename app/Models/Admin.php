<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table = 'admins';

    protected $fillable = ['name', 'password', 'username', 'phone_number', 'photo'];

    protected $hidden = ['password',  'remember_token'];
}
