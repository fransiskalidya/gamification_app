<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLessonAPIRequest;
use App\Http\Requests\API\UpdateLessonAPIRequest;
use App\Models\Lesson;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class lessonController
 * @package App\Http\Controllers\API
 */

class lessonAPIController extends AppBaseController
{
    /** @var  lessonRepository */
    private $lessonRepository;

    public function __construct(LessonRepository $lessonRepo)
    {
        $this->lessonRepository = $lessonRepo;
    }

    /**
     * Display a listing of the lesson.
     * GET|HEAD /lessons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $lessons = $this->lessonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($lessons->toArray(), 'Lessons retrieved successfully');
    }

    /**
     * Store a newly created lesson in storage.
     * POST /lessons
     *
     * @param CreateLessonAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLessonAPIRequest $request)
    {
        $input = $request->all();

        $lesson = $this->lessonRepository->create($input);

        return $this->sendResponse($lesson->toArray(), 'Lesson saved successfully');
    }

    /**
     * Display the specified lesson.
     * GET|HEAD /lessons/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var lesson $lesson */
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            return $this->sendError('Lesson not found');
        }

        return $this->sendResponse($lesson->toArray(), 'Lesson retrieved successfully');
    }

    /**
     * Update the specified lesson in storage.
     * PUT/PATCH /lessons/{id}
     *
     * @param int $id
     * @param UpdateLessonAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLessonAPIRequest $request)
    {
        $input = $request->all();

        /** @var lesson $lesson */
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            return $this->sendError('Lesson not found');
        }

        $lesson = $this->lessonRepository->update($input, $id);

        return $this->sendResponse($lesson->toArray(), 'lesson updated successfully');
    }

    /**
     * Remove the specified lesson from storage.
     * DELETE /lessons/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var lesson $lesson */
        $lesson = $this->lessonRepository->find($id);

        if (empty($lesson)) {
            return $this->sendError('Lesson not found');
        }

        $lesson->delete();

        return $this->sendSuccess('Lesson deleted successfully');
    }
}
