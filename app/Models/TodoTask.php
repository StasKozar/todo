<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    public $timestamps = false;

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
