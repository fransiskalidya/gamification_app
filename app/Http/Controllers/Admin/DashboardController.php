<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BadgeSetting;
use App\Models\User;
use App\Models\UserScore;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function report($user_id = null)
    {

        $users = User::all();

        if (!empty($user_id)) {
            $user_score = UserScore::where(["user_id" => $user_id])->get();
            $total_score = UserScore::where("user_id", $user_id)->sum("score");
            $current_badge = BadgeSetting::where("min", "<=", $total_score)->where("max", ">=", $total_score)->first();
            $take = UserScore::where("user_id", $user_id)->pluck("question_id")->toArray();
            $code_test_score = UserScore::where(["user_id" => $user_id])->whereNotNull("question_id")->get();

            return view("admin.dashboard.report", [
                "score" => $user_score,
                "total_score" => $total_score,
                "current_badge" => $current_badge,
                "percentage" => UserScore::getPercentage($user_id),
                "finish_code_tests" => $take,
                "user_id" => $user_id,
                "users" => $users,
                "code_score" => $code_test_score
            ]);
        }

        return view('admin.dashboard.report', ["user_id" => $user_id, 'users' => $users]);
    }
}