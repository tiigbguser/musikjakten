<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LogRepository;
use App\Log;

use Auth;

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
        if($request->user()){
        	return view('logs.index', [
        		// 'logs' => $this->logs->forUser($request->user()),
        	]);
        }else{
            return redirect('/');
        }
    }


    public function store(Request $request)
    {
    	// $this->validate($request,[
    	// 	'music_data' => 'required',
    	// 	'sound_engine' => 'numeric|required',
    	// 	'action' => 'required',
    	// 	'name' => 'alpha_dash|max:255',
    	// ]);

        // $request->user()->logs()->create([
        //     'music_data' => $request->state,
        //     'sound_engine' => $request->state->soundengine,
        //     'action' => $request->action,
        //     'name' => $request->name,
        // ]);

        // if(Auth::check()){
        //     return response($request, 202);
        // }else{
        //     return response("faaaaaail", 403);
        // }

    	$request->user()->logs()->create([
            'action' => $request->action,
    		'app_state' => $request->state,
    		'name' => $request->name,
    	]);

        return response($request->name, 202);
    }

    //TODO: Make sure you can't destroy someone else logs
    public function destroy(Request $request, Log $log)
    {
        $log->delete();
    }

    public function getJson(Request $request)
    {
        // return $this->logs->forUser($request->user());
        return Log::all();
    }
}
