<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'statu_id',
        'title',
        'description',
        'startDate',
        'endDate',
        'expectedEndDate',
    ];

    /**
     * Get the category that owns the task.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    /**
     * Get the status that owns the task.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'statu_id');
    }

    /**
     * Get the assignments for the task.
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
