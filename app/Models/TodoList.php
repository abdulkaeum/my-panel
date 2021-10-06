<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $casts = [
        'complete'  => 'datetime:Y-m-d H:i:s',
        'flag'      => 'datetime:Y-m-d H:i:s',
        'due_date'  => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(TodoTask::class);
    }
}
