<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Role
 * @package App\Models
 * @version May 30, 2022, 11:47 am UTC
 *
 * @property string $role
 */
class Role extends Model
{


    public $table = 'roles';




    public $fillable = [
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];


}
