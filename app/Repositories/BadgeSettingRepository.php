<?php

namespace App\Repositories;

use App\Models\BadgeSetting;
use App\Repositories\BaseRepository;

/**
 * Class BadgeSettingRepository
 * @package App\Repositories
 * @version May 31, 2022, 3:11 pm UTC
*/

class BadgeSettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return BadgeSetting::class;
    }
}
