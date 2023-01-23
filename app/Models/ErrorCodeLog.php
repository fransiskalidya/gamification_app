<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorCodeLog extends Model
{
    use HasFactory;
    protected $table = "code_error_logs";
    protected $fillable  = ["user_id", "question_id", "error_message", "total_count"];

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class, 'question_id');
    }
}
