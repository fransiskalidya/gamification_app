<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\ErrorCodeLog;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardAPIController extends AppBaseController
{

    public function getChartData(Request $request)
    {
        $err_logs = ErrorCodeLog::select(DB::raw('question_id, count(*) as total'))
            ->groupBy('question_id')
            ->with(["question"])->get();

        return Response([
            "chart_data" => [
                "questions" => $err_logs,
            ]
        ]);
    }
}
