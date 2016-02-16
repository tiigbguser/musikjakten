<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LogRepository;

class LogController extends Controller
{
	protected $logs;

    public function __construct(LogRepository $logs)
    {
    	$this->middleWare('auth');

    	$this->logs = $logs;
    }

    public function index(Request $request)
    {
    	return view('logs.index', [
    		'logs' => $this->logs->forUser($request->user()),
    	]);
    }


    public function store(Request $request)
    {
    	$this->validate($request,[
    		'music_data' => 'required',
    		'sound_engine' => 'numeric|required',
    		'action' => 'required',
    		'name' => 'alpha_dash|max:255',

    	]);

        if(!$request->user()->logs())
        {
            echo 'no logs!';
        }

    	$request->user()->logs()->create([
    		'music_data' => $request->music_data,
    		'sound_engine' => $request->sound_engine,
    		'action' => $request->action,
    		'name' => $request->name,
    	]);

    	return redirect('/logs');
    }

    public function getJson(Request $request)
    {
        return $this->logs->forUser($request->user());
    }
}
