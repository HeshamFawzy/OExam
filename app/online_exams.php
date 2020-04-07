<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
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
 */
class online_exams extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['online_exam_title', 'online_exam_datetime', 'online_exam_duration', 'total_question', 'marks_per_right_answer', 'marks_per_wrong_answer', 'online_exam_status', 'online_exam_code', 'created_at', 'updated_at'];

}
