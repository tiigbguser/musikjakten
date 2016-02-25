@extends('layouts.app')

@section('content')

	@include('common.errors')

	


		<div id="settings" class="container">
			<form v-on:submit.prevent="saveSettings" action="{{ url('json/settings/save') }}" method="POST" >
				{!! csrf_field() !!}

				<label for="name">name</label>
				<input v-model="profile.name" type="text" name="name">
				<button type="submit">change name</button>
			</form>

		    <div class="row">
		        <div class="col-md-10 col-md-offset-1">
		            <div class="panel panel-default">
		            	<pre>
			                @{{ profile | json }}
			            </pre>
		            </div>
		        </div>
		    </div>
		</div>
@endsection