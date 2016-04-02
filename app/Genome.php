<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Genome extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'genome', 
    ];

    protected $casts = [
        'genome' => 'array'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // public function previousLog()
    // {
    // 	return $this->hasOne(Log::class, 'previous_log_id');
    // }

    // public function nextLog()
    // {
    // 	return $this->belongsTo(Log::class, 'previous_log_id');
    // }
}
