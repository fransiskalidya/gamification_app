<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "levels";
    protected $fillable=[
        'name',
        'course_id',
        'description'
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id');
    }
}
