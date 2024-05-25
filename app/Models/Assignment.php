<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'assignments';

    // The attributes that are mass assignable
    protected $fillable = [
        'task_id',
        'user_id',
    ];

    /**
     * Get the task associated with the assignment.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the user associated with the assignment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
