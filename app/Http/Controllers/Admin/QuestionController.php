<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Answer;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Response;

class QuestionController extends AppBaseController
{
    /** @var QuestionRepository $questionRepository*/
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $questions = $this->questionRepository->paginate(10);

        return view('admin.questions.index')
            ->with('questions', $questions);
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        $contents = Content::all()->pluck("title", "id");
        return view('admin.questions.create', ["contents" => $contents, "answers"=>[]]);
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $question = $this->questionRepository->create($input);
        if($request['is_essay']!='1'){
            for($i=0; $i<4; $i++){
                $ans = $request["answers_$i"];
                $is_r = @$request["is_right_$i"];
                Answer::create(["question_id"=>$question->id, "answer"=>$ans, "is_right" => $is_r]);
            }
        }


        Flash::success('Question saved successfully.');

        return redirect(route('admin.questions.index'));
    }

    /**
     * Display the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('admin.questions.index'));
        }

        return view('admin.questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->find($id);

        $contents = Content::all()->pluck("title", "id");
        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('admin.questions.index'));
        }

        return view('admin.questions.edit')->with('question', $question)->with("contents", $contents)->with("answers", $question->answers);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param int $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('admin.questions.index'));
        }
        $question = $this->questionRepository->update($request->all(), $id);

        $answers = $question->answers;
        if($request['is_essay']!='1') {
            if ($answers->count() == 0) {
                for ($i = 0; $i < 4; $i++) {
                    $ans = $request["answers_$i"];
                    $is_r = @$request["is_right_$i"];

                    Answer::create(["question_id" => $question->id, "answer" => $ans, "is_right" => $is_r]);
                }
            } else {
                for ($i = 0; $i < 4; $i++) {
                    $ans = $request["answers_$i"];
                    $is_r = @$request["is_right_$i"];
                    $id_ans = @$request["answer_id_$i"];
                    if (empty($id_ans)) {
                        Answer::create(["question_id" => $question->id, "answer" => $ans, "is_right" => $is_r]);
                    } else {
                        $answ = Answer::find((int)$id_ans);
                        $answ->update(["question_id" => $question->id, "answer" => $ans, "is_right" => $is_r]);
                    }
                }
            }
        } else {
            $question = $this->questionRepository->update(["is_essay" => 1], $id);
        }
        Flash::success('Question updated successfully.');
        Log::debug($request->all());

        return redirect(route('admin.questions.index'));
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('admin.questions.index'));
        }

        $this->questionRepository->delete($id);

        Flash::success('Question deleted successfully.');

        return redirect(route('admin.questions.index'));
    }
}
