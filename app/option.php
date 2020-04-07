<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $question_id
 * @property int $option_number
 * @property string $option_title
 * @property string $created_at
 * @property string $updated_at
 * @property Question $question
 */
class option extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['question_id', 'option_number', 'option_title', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
