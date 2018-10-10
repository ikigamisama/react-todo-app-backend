<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Todo extends Model
{
    protected $fillable = ['todo_name','todo_description','todo_date','todo_time','is_already_todo'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
