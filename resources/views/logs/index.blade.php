
@extends('layouts.app')

@section('content')

	@include('common.errors')

	<form action="{{ url('log') }}" method="POST" >
		{!! csrf_field() !!}
		<label for="music_data">music data</label>
		<input type="text" name="music_data">

		<input type="hidden" name="sound_engine" value="1">
		<input type="hidden" name="action" value="play">

		<label for="name">name</label>
		<input type="text" name="name">
		<button type="submit">add log</button>
	</form>

	<div id="hello" class="container">
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	                <p v-for="log in logs">
                		<b>@{{log.id}}</b>
                		@{{log.action}}
                		<b>
                			@{{log.app_state.selected}}
                		</b>
                	</p>
	            </div>
	        </div>
	    </div>
	    <pre>
			@{{ logs | json}}
		</pre>
	</div>

<script src="js/logs.js"></script>

	


@endsection