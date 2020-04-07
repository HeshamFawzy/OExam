<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $examiner_id
 * @property int $exam_id
 * @property string $attendance_status
 * @property string $created_at
 * @property string $updated_at
 * @property OnlineExam $onlineExam
 * @property Examiner $examiner
 */
class user_exam_enroll extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['examiner_id', 'exam_id', 'attendance_status', 'created_at', 'updated_at'];

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
}
