<?php

namespace App\Http\Controllers;

use App\Models\ErrorCodeLog;
use App\Models\Question;
use App\Models\UserCodeTestScore;
use App\Models\UserScore;
use App\Models\ExerciseCodeLog;
use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CodeTestController extends Controller
{
    //
    public function index($course_id, Request $request)
    {
        $question = Question::find($course_id);
        $score = UserScore::where("user_id", Auth::id())->where("question_id", $course_id);
        // $level = Level::firstwhere('id',$request->level_id);
        // dd($level);

        $duration  = "";

        $user_score = $score->first();
        $err_logs = ErrorCodeLog::where("user_id", Auth::id())->where("question_id", $course_id)->get();
        $exer_logs = ExerciseCodeLog::where("user_id", Auth::id())->where("question_id", $course_id)->orderBy('id','DESC')->get();

        if ($user_score) {
            $a = Carbon::parse($user_score->started_at);
            $b = Carbon::parse($user_score->ended_at);
            $duration = $b->diff($a)->format('%Hh %Im %Ss');
        }

        $isFinish = false;
        if ($score->count() > 0) {
            $isFinish = true;
        }

        return view("student_courses.code_test", [
            "question" => $question,
            'score' => $score->sum('score'),
            'is_finish' => $isFinish,
            'user_score' => $user_score,
            'duration' => $duration,
            'error_logs' => $err_logs,
            'exercise_logs'=> $exer_logs
        ]);
    }

    public function codeTestSubmit(Request $request)
    {
        $model = UserScore::where("user_id", $request->get("user_id"))->where("question_id", $request->get("question_id"));
        $question = Question::find($request->get("question_id"));
        Log::debug($model->count());
        if ($model->count() == 0) {
            UserScore::create(
                [
                    "user_id" => $request->get("user_id"),
                    "question_id" => $request->get("question_id"),
                    "content_id" => $request->get("content_id"),
                    "score" => $request->get('score') == 10 ? $question->score : 0,
                    "started_at" => $request->get("started_at"),
                    "ended_at" => $request->get("ended_at"),
                    "on_timer" => $request->get("on_timer")
                ]
            );
        } else{
            $check = UserScore::where("user_id", $request->get("user_id"))->where("question_id", $request->get("question_id"))->first();
            $user_score = UserScore::firstwhere('id', $check->id);
            $user_score->score = $request->get('score') == 10 ? $question->score : 0;
            $user_score->save();
        }

        return redirect(
            route('student_course.my_course.detail.content', [
                'course_id' => $request->get("course_id"),
                'content_id' => $request->get('content_id'),
                'level_id'  => $request->get('level_id')
            ])
        );
    }
}