<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\BaseRepository;

/**
 * Class lessonRepository
 * @package App\Repositories
 * @version May 30, 2022, 12:03 pm UTC
 */

class LessonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lesson::class;
    }
}
