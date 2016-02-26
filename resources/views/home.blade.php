@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <div id="hello">
                        <article v-for="log in logs">
                            <b>@{{log.name}}</b>
                            <br />
                            @{{log.music_data}}
                        </article>
                    <div>

                    <button v-on:click="newGenome" > new sound</ button>


                </div>

                <pre>
                </pre>
            </div>
        </div>
    </div>
</div>


<script>
var genome=[1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1];
</script>
<script src="js/gibber.js"> </script>
<script src="js/home.js"> </script>
<script>
</script>

@endsection
