<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Repositories\LogRepository;

class ProfileController extends Controller
{
    public function __construct(LogRepository $logs)
    {
    	$this->middleWare('auth');
    }

    public function index(Request $request)
    {
    	$profile = $request->user();
    	return view('profile.settings', ['profile' => $profile]);

    }

    public function store(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->save();
    	//TODO: Validate this shit!!
    	// $this->validate($request,[

    	// ]);

    }

    public function getJson(Request $request)
    {
        return $request->user();
    }
}

?>