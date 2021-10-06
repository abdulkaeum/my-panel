<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    use HasFactory;

    protected $fillable = ['task'];

    public function todolist()
    {
        return $this->belongsTo(TodoList::class);
    }
}
