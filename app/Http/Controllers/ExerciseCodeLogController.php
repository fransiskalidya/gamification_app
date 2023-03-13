<?php

namespace App\Http\Controllers;
use App\Models\ExerciseCodeLog;
use Illuminate\Http\Request;

class ExerciseCodeLogController extends Controller
{
    public function create(Request $request)
    {
        $user_id = $request->get("user_id");
        $question = $request->get("question_id");
        $message = $request->get("message_content");
        $is_error = $request->get("is_error");

        $model = ExerciseCodeLog::create([
            "user_id" => $user_id,
            "question_id" => $question,
            "message" => $message,
            "total_count" => 1,
            "is_error"  => $is_error
        ]);

        return response($model);
    }
}
