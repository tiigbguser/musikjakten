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


                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/vendor.js"></script>
<script src="js/home.js"> </script>

@endsection
