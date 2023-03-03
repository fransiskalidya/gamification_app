<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Repositories\LessonRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Response;

class LessonController extends AppBaseController
{
    /** @var LessonRepository $lessonRepository*/
    private $lessonRepository;

    public function __construct(LessonRepository $lessonRepo)
    {
        $this->lessonRepository = $lessonRepo;
    }

    /**
     * Display a listing of the lesson.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $lessons = $this->lessonRepository->paginate(25);

        return view('admin.lessons.index')
            ->with('lessons', $lessons);
    }

    /**
     * Show the form for creating a new lesson.
     *
     * @return Response
     */
    public function create()
    {
        $courses = Course::all()->pluck("course_name", "id")->toArray();
        $level = Level::all()->pluck("name","id")->toArray();
        Log::debug($courses);
        return view('admin.lessons.create', ["courses" => $courses, "level" => $level]);
    }

    /**
     * Store a newly created lesson in storage.
     *
     * @param CreatelessonRequest $request
     *
     * @return Response
     */
    public function store(CreateLessonRequest $request)
    {
        $input = $request->all();

        $lesson = $this->lessonRepository->create($input);

        Flash::success('Lesson saved successfully.');

        return redirect(route('admin.lessons.index'));
    }

    /**
     * Display the specified lesson.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            Flash::error('Lesson not found');

            return redirect(route('admin.lessons.index'));
        }

        return view('admin.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lesson = $this->lessonRepository->find($id);
        $courses = Course::all()->pluck("course_name", "id")->toArray();
        $level = Level::all()->pluck("name","id")->toArray();

        if (empty($lesson)) {
            Flash::error('Lesson not found');

            return redirect(route('admin.lessons.index'));
        }

        return view('admin.lessons.edit', compact('lesson','courses','level'));
    }

    /**
     * Update the specified lesson in storage.
     *
     * @param int $id
     * @param UpdatelessonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLessonRequest $request)
    {
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            Flash::error('Lesson not found');

            return redirect(route('admin.lessons.index'));
        }

        $lesson = $this->lessonRepository->update($request->all(), $id);

        Flash::success('Lesson updated successfully.');

        return redirect(route('admin.lessons.index'));
    }

    /**
     * Remove the specified lesson from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            Flash::error('Lesson not found');

            return redirect(route('admin.lessons.index'));
        }

        $this->lessonRepository->delete($id);

        Flash::success('Lesson deleted successfully.');

        return redirect(route('admin.lessons.index'));
    }
}
