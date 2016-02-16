<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'music_data', 'sound_engine', 'action', 'name',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function previousLog()
    {
    	return $this->hasOne(Log::class, 'previous_log_id');
    }

    public function nextLog()
    {
    	return $this->belongsTo(Log::class, 'previous_log_id');
    }

}
