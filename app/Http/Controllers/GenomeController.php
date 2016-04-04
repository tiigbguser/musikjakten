<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Genome;

class GenomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return response($request->user()->id, 202);
        return $request->user()->genomes;
    }

    public function others(Request $request){
        return Genome::where('user_id', '!=', $request->user()->id)->get();
    }

    public function all(){
        // return response('hejhopp: [1,2,3]',202);
        return Genome::all();
    }

    public function store(Request $request)
    {
    	// $this->validate($request,[
    	// 	'name' => 'alpha_dash|max:255',
    	// 	'genome' => 'required',
    	// ]);

        // if(Auth::check()){
        //     return response($request, 202);
        // }else{
        //     return response("faaaaaail", 403);
        // }

    	$request->user()->genomes()->create([
    		'name' => $request->name,
            'genome' => $request->genome,
    	]);

        return response($request->all(), 202);
    }
}
