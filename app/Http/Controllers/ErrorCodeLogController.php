<?php

namespace App\Http\Controllers;

use App\Models\ErrorCodeLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ErrorCodeLogController extends Controller
{
    //

    public function create(Request $request)
    {
        $user_id = $request->get("user_id");
        $question = $request->get("question_id");
        $err = $request->get("error_message");

        $model = ErrorCodeLog::create([
            "user_id" => $user_id,
            "question_id" => $question,
            "error_message" => $err,
            "total_count" => 1
        ]);

        return response($model);
    }
}