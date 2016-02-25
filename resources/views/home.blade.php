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
<script src="js/home.js"> </script>
<script>

//Start an instance!!!!
Gibber.init();


// use this as Gibber sound engine

Gibber.scale.root.seq( ['c4','eb4'], 2)

// this function helps passing references to array members as arguments to the underlying sound engine
Proxy = function( obj, key ) {
  var out = new Gibber.Audio.Core.Proxy2( obj, key )
  return out
}

// this function is a workaround to pass part of the genom to a sequencer (which needs either a function or a pattern as argument)
plutt = function() {
  return 10*genome[ 4 + plutt.phase++ % 6 ]
}
plutt.phase = 0

// this line creates a little blipp sequence, where pitches come from the genome
// s = Synth('bleep').note.seq( plutt, 1/8 )




a = Mono('bass').note.seq( plutt, 1/8 )

b = EDrums('x-o-x-o-')
b.snare.snappy = 1

c = Mono('easyfx')
  .note.seq( plutt, [1/4,1/8,1/2,1,2] )

// these since oscillators create a cluster with frequencies from the genome
d = Sine( Mul(Proxy( genome, 0 ),1000), .05 )
e = Sine( Mul(Proxy( genome, 1 ),1000), .05 )
f = Sine( Mul(Proxy( genome, 2 ),1000), .05 )
g = Sine( Mul(Proxy( genome, 3 ),1000), .05 )


// then you can execute code like the following to change the genome values

// genome[0]=Math.random()

// for(var i=0;i<10;i++) {
//     genome[i]=Math.random();
// }

// but you cannot substitute the whole array like the following, because that creates a new array object and breaks the references
// genome=[1,0.2,0.4,0.6,0.2,0.9,0.0,0.4,1.0,0.1];





</script>

@endsection
