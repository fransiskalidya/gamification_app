<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionAPIRequest;
use App\Http\Requests\API\UpdateQuestionAPIRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\UserScore;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Response;
use function MongoDB\BSON\toJSON;

/**
 * Class QuestionController
 * @package App\Http\Controllers\API
 */

class QuestionAPIController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     * GET|HEAD /questions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questions = $this->questionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($questions->toArray(), 'Questions retrieved successfully');
    }

    public function getQuestionAnswer($content_id){
        $qa = Question::where("content_id", $content_id)->with("answers")->get();
        return $this->sendResponse([
            ...$qa->toArray(),
        ], "success");
    }

    public function checkAnswer(Request $request){
        dd('masuk');
        //if(Auth::check()){
            $score = 0;
            $data = json_decode($request->getContent(), true);
            foreach ($data["answer_ids"] as $ans){
                $answer = Answer::find($ans);
                $is_right = (bool) $answer->is_right;
                if($is_right){
                    $get_score = $answer->question->score;
                    $score+=$get_score;
                }
            }

            $user_score = UserScore::where("user_id", $data["user_id"]);
            //if($user_score->count() == 0){
                UserScore::create(["user_id"=> $data["user_id"], "content_id" => $data["content_id"], "score" => $score ]);
            //}
            return $this->sendResponse(["score"=>$score], "success");
        //}

    }
    /**
     * Store a newly created Question in storage.
     * POST /questions
     *
     * @param CreateQuestionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionAPIRequest $request)
    {
        $input = $request->all();

        $question = $this->questionRepository->create($input);

        return $this->sendResponse($question->toArray(), 'Question saved successfully');
    }

    /**
     * Display the specified Question.
     * GET|HEAD /questions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    // public function show($id)
    // {
    //     /** @var Question $question */
    //     $question = $this->questionRepository->find($id);
    //     dd([$id,$question]);

    //     if (empty($question)) {
    //         return $this->sendError('Question not found');
    //     }

    //     return $this->sendResponse($question->toArray(), 'Question retrieved successfully');
    // }

    /**
     * Update the specified Question in storage.
     * PUT/PATCH /questions/{id}
     *
     * @param int $id
     * @param UpdateQuestionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question = $this->questionRepository->update($input, $id);

        return $this->sendResponse($question->toArray(), 'Question updated successfully');
    }

    /**
     * Remove the specified Question from storage.
     * DELETE /questions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question->delete();

        return $this->sendSuccess('Question deleted successfully');
    }
}
