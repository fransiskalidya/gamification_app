<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserScore extends Model
{
    use HasFactory;

    protected $table = "user_scores";
    protected $fillable  = ["user_id", "content_id", "score", "question_id", "started_at", "ended_at", "on_timer"];

    public static function getScore()
    {
        $score =  UserScore::where("user_id", Auth::id())->sum("score");
        return $score;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getPercentage($user_id = null)
    {
        $user = !empty($user_id) ? $user_id : Auth::id();

        $question = Question::where("is_essay", "1")->pluck("id");
        $answeredQues = UserScore::where("user_id", $user)->whereIn("question_id", $question);

        return number_format((float)$answeredQues->count() / $question->count() * 100, 1, '.', '');
    }
}