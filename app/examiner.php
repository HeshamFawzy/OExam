<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $gender
 * @property string $address
 * @property integer $mobile_no
 * @property string $filename
 * @property string $mime
 * @property string $original_filename
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class examiner extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'gender', 'address', 'mobile_no', 'filename', 'mime', 'original_filename', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
