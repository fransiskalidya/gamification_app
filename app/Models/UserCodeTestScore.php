<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCodeTestScore extends Model
{
    use HasFactory;

    protected $table = "user_code_test_score";
    protected $fillable = ["question_id", "user_id", "score"];


}
