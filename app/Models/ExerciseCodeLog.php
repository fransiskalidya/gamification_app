<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseCodeLog extends Model
{
    use HasFactory;
    protected $table = "code_history_logs";

    protected $fillable  = [
        "user_id", 
        "question_id", 
        "message", 
        "total_count",
        "is_error"
    ];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class, 'question_id');
    }
}
