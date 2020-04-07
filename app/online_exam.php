<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $admin_id
 * @property string $online_exam_title
 * @property string $online_exam_datetime
 * @property string $online_exam_duration
 * @property int $total_question
 * @property string $marks_per_right_answer
 * @property string $marks_per_wrong_answer
 * @property string $online_exam_status
 * @property string $online_exam_code
 * @property string $created_at
 * @property string $updated_at
 * @property Admin $admin
 * @property Question[] $questions
 * @property UserExamEnroll[] $userExamEnrolls
 * @property UserExamQuestionAnswer[] $userExamQuestionAnswers
 */
class online_exam extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['admin_id', 'online_exam_title', 'online_exam_datetime', 'online_exam_duration', 'total_question', 'marks_per_right_answer', 'marks_per_wrong_answer', 'online_exam_status', 'online_exam_code', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question', 'exam_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userExamEnrolls()
    {
        return $this->hasMany('App\UserExamEnroll', 'exam_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userExamQuestionAnswers()
    {
        return $this->hasMany('App\UserExamQuestionAnswer', 'exam_id');
    }
}
