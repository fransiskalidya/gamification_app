<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class BadgeSetting
 * @package App\Models
 * @version May 31, 2022, 3:11 pm UTC
 *
 * @property string $name
 * @property integer $min
 * @property integer $max
 */
class BadgeSetting extends Model
{


    public $table = 'badge_settings';




    public $fillable = [
        'name',
        'file',
        'min',
        'max'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'file' => 'string',
        'min' => 'integer',
        'max' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
