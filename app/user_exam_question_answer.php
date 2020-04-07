<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $examiner_id
 * @property int $exam_id
 * @property int $question_id
 * @property string $user_answer_option
 * @property string $marks
 * @property string $created_at
 * @property string $updated_at
 * @property OnlineExam $onlineExam
 * @property Examiner $examiner
 * @property Question $question
 */
class user_exam_question_answer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['examiner_id', 'exam_id', 'question_id', 'user_answer_option', 'marks', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onlineExam()
    {
        return $this->belongsTo('App\OnlineExam', 'exam_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examiner()
    {
        return $this->belongsTo('App\Examiner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
