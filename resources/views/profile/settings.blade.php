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


				<div v-for="category in questions" class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-uppercase">
							@{{$key}}
						</h1>
					</div>	
					<div class="panel-body">
						<template v-for="(fieldkey, formfield) in category">
							<div v-if="formfield.type === 'text'" class="form-group">
								<label tabindex="@{{$index+1}}" for="@{{fieldkey}}">@{{formfield.question}} </label>
								<input v-on:input="fieldChange" type="@{{formfield.type}}" placeholder="@{{formfield.placeholder}}" name="@{{fieldkey}}" id="input@{{$fieldkey}}" v-model="profile.demographic_data[fieldkey]" value="@{{profile.demographic_data[fieldkey]}}" class="form-control" >
							</div>

							<div v-if="formfield.type === 'radio'" class="form-group">
								<label for="@{{fieldkey}}">@{{formfield.question}} </label>

								<div class="radio" v-for="radiofield in formfield.schema" >
									<label tabindex="@{{$index+1}}" for="@{{$key}}">
										<input v-on:input="fieldChange" type="@{{formfield.type}}" name="@{{fieldkey}}" id="input@{{$key}}" v-model="profile.demographic_data[fieldkey]" value="@{{radiofield}}" >
										@{{radiofield}}
									</label>
								</div>
							</div>



							<div v-if="formfield.type === 'numberscale'">
								<label class="form-group" for="@{{fieldkey}}">@{{formfield.question}} </label>

								<div v-for="numberfield in formfield.schema" name="@{{fieldkey}}" class="form-group row">
										<label class="col-sm-7 col-md-4" style="display:block; font-size: 100%" for="@{{$key}}">@{{numberfield}}</label>

										<div name="@{{$key}}" class="btn-group col-sm-5 col-md-4" data-toggle="buttons" v-radio="profile.demographic_data[fieldkey][$key]">
											 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="1" />1</label>
											 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="2" />2</label>
											 <label v-on:click="fieldChange" class="btn btn-primary"> <input tabindex="@{{$index+1}}" type="radio" autocomplete="off" value="3" />3</label>
											 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="4" />4</label>
											 <label v-on:click="fieldChange" class="btn btn-primary"> <input type="radio" autocomplete="off" value="5" />5</label>
										</div>
								</div>
							</div>
						</template>
					</div>
				</div>

				<div class="form-group">
					<button :disabled="saved" class="btn btn-primary" type="submit">Spara!</button>
					<a class="btn btn-danger" v-show="!saved" href="/" role="button">Avbryt</a>
				</div>

				<div v-show="saveFailed" transition="fade" class="inline alert alert-danger"><p>Whooops! Jag lyckades inte spara inställningarna.</p></div>
				<div v-show="saved and !saveSuccess" transition="fade" class="inline alert alert-warning"><p>Dina inställningar är sparade</p></div>

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