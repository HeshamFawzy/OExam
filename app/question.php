<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $exam_id
 * @property string $question_title
 * @property string $answer_option
 * @property string $created_at
 * @property string $updated_at
 * @property OnlineExam $onlineExam
 * @property Option[] $options
 * @property UserExamQuestionAnswer[] $userExamQuestionAnswers
 */
class question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['exam_id', 'question_title', 'answer_option', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onlineExam()
    {
        return $this->belongsTo('App\OnlineExam', 'exam_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany('App\Option');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userExamQuestionAnswers()
    {
        return $this->hasMany('App\UserExamQuestionAnswer');
    }
}
