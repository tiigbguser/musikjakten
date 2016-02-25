@extends('layouts.app')

@section('content')

	@include('common.errors')

	


		<div id="settings" class="container">
			<form v-on:submit.prevent="saveSettings" method="POST" >
				{!! csrf_field() !!}
				<div class="form-group">
					<label for="name">Användarnamn</label>
					<input v-on:input="fieldChange" class="form-control" v-model="profile.name" type="text" name="name">
				</div>

				<div class="form-group">
					<label for="email">E-mail</label>
					<input v-on:input="fieldChange" class="form-control" v-model="profile.email" type="text" name="email">
				</div>

				<div v-for="userfield in profile.demographic_data" class="form-group">
					<label for="@{{$key}}" >@{{$key}} </label>
					<input v-on:input="fieldChange" type="text" name="@{{$key}}" id="input@{{$key}}" v-model="userfield" value="@{{userfield}}" class="form-control">
				</div>

				<button :disabled="saved" class="btn btn-primary" type="submit">Spara!</button>
				<a v-show="!saved" href="/">
					<button class="btn btn-danger" type="button">Avbryt</button>
				</a>
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