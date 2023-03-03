<?php

namespace App\Models;

use Eloquent as Model;



/**
 * Class Course
 * @package App\Models
 * @version May 30, 2022, 11:55 am UTC
 *
 * @property string $course_name
 * @property string $description
 * @property string $image
 * @property integer $published
 */
class Course extends Model
{


    public $table = 'courses';




    public $fillable = [
        'course_name',
        'description',
        'image',
        'published'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_name' => 'string',
        'description' => 'string',
        'image' => 'string',
        'published' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function student_courses(){
        return $this->hasMany(StudentCourse::class);
    }

    public function level(){
        return $this->hasMany(Level::class);
    }


}
