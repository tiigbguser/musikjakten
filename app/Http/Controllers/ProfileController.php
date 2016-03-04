<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Auth;

use App\User;
use App\Question;
use App\Repositories\LogRepository;


class ProfileController extends Controller
{
    public function __construct(LogRepository $logs)
    {
    	$this->middleWare('auth');
    }

    public function index(Request $request)
    {
        if(Auth::check()){
        	$profile = $request->user();
        	return view('profile.settings', ['profile' => $profile]);
        }

    }

    public function store(Request $request)
    {
        if(Auth::check()){
            $user = $request->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->demographic_data = $request->demographic_data;
            $user->save();


            // return response("böög", 404);

        	//TODO: Validate this shit!!
        	// $this->validate($request,[

        	// ]);
        }

    }

    public function getJson(Request $request)
    {
        $response = ['user' => '',
                    'questions' => ''];

        $response['user'] = $request->user();

        // $response['questions'] = Question::all()->keyBy('key');
        try{
            $questions = collect(json_decode(Storage::get('questionschema.json'),true)); 
        }catch(Exception $e){
            echo $e;
        }

        $response['questions'] = $questions;
        return $response;
    }
}

?>