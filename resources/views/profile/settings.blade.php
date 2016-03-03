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


				<div v-for="category in profile.demographic_data" class="panel panel-default">
					<div class="panel panel-heading">
						<h3 class="panel-title">
							@{{$key}}
						</h3>
					</div>	
					<div v-for="userfield in category" class="form-group panel-body">
						<div v-if="this.getQuestion($key)"> baaaaajs </div>
						<div v-else>snopp</div>
						<div v-if="$key === 'numberscale'">
							<label>@{{$key}}</label>

							<div v-for="numberfield in userfield" class="form-group">

								<p>@{{$key}}</p>

								<div name="@{{$key}}" class="btn-group" data-toggle="buttons" v-radio="numberfield">
								 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="1" />1</label>
								 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="2" />2</label>
								 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="3" />3</label>
								 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="4" />4</label>
								 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="5" />5</label>
								</div>

								<span>Picked: @{{ numberfield}}</span>

								{{-- <label for="@{{$key}}" >@{{$key}} </label>
								<input v-on:input="fieldChange" type="text" name="@{{$key}}" id="input@{{$key}}" v-model="number" value="@{{number}}" class="form-control"> --}}
							</div>
						</div>
						<template v-else>
							<label for="@{{$key}}" >@{{$key}} </label>
							<input v-on:input="fieldChange" type="text" name="@{{$key}}" id="input@{{$key}}" v-model="userfield" value="@{{userfield}}" class="form-control">
						</template>
					</div>
				</div>

				<div class="form-group">
					<button :disabled="saved" class="btn btn-primary" type="submit">Spara!</button>
					<a v-show="!saved" href="/">
						<button class="btn btn-danger" type="button">Avbryt</button>
					</a>
				</div>

				<div v-show="saveFailed" transition="fade" class="inline alert alert-danger"><p>Whooops! Jag lyckades inte spara inställningarna.</p></div>

				<div v-show="saveSuccess" transition="fade" class="inline alert alert-success"><p>Dina inställningar har sparats!</p></div>
				
			</form>

		    <div class="row">
		        <div class="col-md-10 col-md-offset-1">
		            <div class="panel panel-default">
		            	<pre>
			                @{{ profile | json }}
			            </pre>
			            <pre>
			            	@{{ questions | json }}
			            </pre>
		            </div>
		        </div>
		    </div>
		</div>
@endsection