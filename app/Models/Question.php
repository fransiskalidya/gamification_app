<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Question
 * @package App\Models
 * @version May 30, 2022, 3:00 pm UTC
 *
 * @property \App\Models\Content $content
 * @property integer $content_id
 * @property string $question
 * @property string $image
 * @property integer $score
 */
class Question extends Model
{
    use SoftDeletes;


    public $table = 'questions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'content_id',
        'question',
        'question_name',
        'image',
        'score',
        'is_essay',
        'timer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'content_id' => 'integer',
        'question' => 'string',
        'question_name' => 'string',
        'image' => 'string',
        'score' => 'integer',
        'is_essay' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function content()
    {
        return $this->belongsTo(\App\Models\Content::class, 'content_id');
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class);
    }
}
