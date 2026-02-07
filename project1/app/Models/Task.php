<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    protected $fillable = ['title','isDone','U_ID'];
    
    public function user(){
        return $this->belonsTo(User::class,'U_ID','U_ID');
    } 
}
