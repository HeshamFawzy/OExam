<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property OnlineExam[] $onlineExams
 */
class admin extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function onlineExams()
    {
        return $this->hasMany('App\OnlineExam');
    }
}
