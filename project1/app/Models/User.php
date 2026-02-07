<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Task;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable =[
        'name',
        'email',
        'pass',
        'U_ID'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'U_ID','U_ID');
    }
}
