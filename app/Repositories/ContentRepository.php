<?php

namespace App\Repositories;

use App\Models\Content;
use App\Repositories\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Repositories
 * @version May 30, 2022, 2:15 pm UTC
*/

class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'lesson_id'
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
        return Content::class;
    }
}
