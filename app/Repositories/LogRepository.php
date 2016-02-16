<?php

namespace App\Repositories;

use App\User;
use App\Log;

class LogRepository
{

	public function forUser(User $user)
	{
		return Log::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
	}
}