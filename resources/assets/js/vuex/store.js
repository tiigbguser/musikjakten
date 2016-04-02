// import Vue from '../vendor/vue'
var Vue = require('../vendor/vue');

// import VueResource from '../vendor/vue-resource'

// import Vuex from '../vendor/vuex'
var Vuex = require('../vendor/vuex');


// Vue.use(VueResource);
Vue.use(Vuex);

// const dummygenome1 = [1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1]
// const dummygenome2 = [1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1,1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1]

const GENOMESIZE = 100;

const state = {
	parents: [
		{	
			name:'',
			genome:[]
		}, 
		{
			name:'',
			genome:[]
		}
	],
	children: [
		{	
			name:'',
			genome:[]
		}, 
		{
			name:'',
			genome:[]
		},
		{	
			name:'',
			genome:[]
		}, 
		{
			name:'',
			genome:[]
		},
		{
			name:'',
			genome:[]
		},
		],
	jumpProbability:0.1,
	selected: 0,
	audioplayer: {index: 0, playing: false},
	soundengine: 0
}

function getGenome(state, index){
	if(index < 2){
		return state.parents[index];
	}else if(index < 7){
		return state.children[index-2];
	}else{
		console.log("the fuck. Index out of bound!");
	}
}

// function generateRandomGenome (){

// }


const mutations = {
	SAVE (state, index, name) {
		state.selected = index;
		genome = getGenome(state, index);
		genome.name = name;
	},
	SELECT (state, index){
		state.selected = index;
	},
	SETSOUNDENGINE (state, index){
		state.soundengine = index;
	},
	INITIALIZE (state){
		state.parents.$set(0, {name:'',genome:[]});
	 	state.parents.$set(1, {name:'',genome:[]});
		for(var i=0;i<5;i++) {
			state.children.$set(i, {name:'',genome:[]});
		}

		state.audioplayer.index=0;
		state.audioplayer.playing = false;
		state.jumpProbability = 0.1;

		state.selected = 0;
	},
	LOADGENOMEINTO(state, genome, index){
		state.selected = index;
		if(index < 2){
			state.parents.$set(index, genome);
		}else{
			state.children.$set(index-2, genome);
		}
	},
	RANDOM (state, index){
		state.selected = index;
		var genome = getGenome(state, index);
		genome.name = '';
		for(var i=0;i<GENOMESIZE;i++) {
		 	genome.genome.$set(i ,Math.random());
		}
	},
	RANDOMIZEALL (state){
		for(var i=0;i<GENOMESIZE;i++) {
		 	state.parents[0].name = '';
		 	state.parents[0].genome.$set(i ,Math.random());

		 	state.parents[1].name = '';
		 	state.parents[1].genome.$set(i ,Math.random());

		 	for(var j = 0; j < state.children.length; j++){
		 		state.children[j].name = '';
		 		state.children[j].genome.$set(i ,Math.random());
		 	}
		}
	},
	MUTATE (state, index){
		state.selected = index;
		var genome = getGenome(state, index);
		const mutate_prob=0.5;
		const mutate_range=0.2;

		// var counter = 0;
		genome.name = '';
		for (var i=0;i<genome.genome.length;i++)
		{

			if (Math.random()<mutate_prob)
			{
				// counter++;
				var value = genome.genome[i];
				value += 2*mutate_range*Math.random()-mutate_range;
				if (value>1){
					 // value=1; // clip
					 value=-(value-1)+1; // spegla
				}else if (value<0){
					 // value=0; // clip
					 value= -value; // spegla
				}

				genome.genome.$set(i, value);
				// console.log("changed at index " + i);
			}
		}
		// console.log("changed " + counter + " positions");
	},
	CROSSBREED (state, index1, index2){
		var mother = getGenome(state, index1);
		var father = getGenome(state, index2);

		// const jump_prob = 0.1;

		state.parents.$set(0, mother);
		state.parents.$set(1, father);

		// console.log("mother: " + mother);
		// console.log("father: " + father);



		for(var childIndex = 0; childIndex < state.children.length; childIndex++){
			var newChild = {name:'', genome:[]};
			var sourceSide = Math.floor((Math.random() * 2));
			
			// var counter = 0;

			for(var i = 0; i < mother.genome.length || i < father.genome.length; i++){
				newChild.genome[i] = state.parents[sourceSide].genome[i];

				if(Math.random() < state.jumpProbability){
					sourceSide++;
					sourceSide %= 2;
					// counter++;
				}
			}
			state.children.$set(childIndex, newChild);
		}

		// console.log("child: " + newChild);
		// console.log("nr of jumps: " + counter);
	}

}

//This is where we interact with the database.
//I would have preferred using vue-resource but it doesn't seem to work.
//trying with jquery
const persistence = {
	onInit (state, store) {
		//record initial state
	},
	onMutation (mutation, state, store) {
		//called after every mutation
		//mutation comes in the format of {type, payload}



		if(mutation.type === 'SAVE'){
			var genomeContainer = getGenome(state, mutation.payload[0]);
			$.post( 'json/genome/save', (genomeContainer), 'json')
				.done(function(data) {
					console.log(data);
				})
				.fail(function(data) {
					alert( "couldn't save!");
				})
				.always(function(data) {
				});
		}
		// else{
			// alert('bajs');
			var sendData = {
								action: mutation.type,
								state: state,
								name: ''
							};
			$.post( 'json/logs/save', (sendData), 'json')
			  .done(function(data) {
			  	console.log(data);
			    // alert( data);
			  })
			  .fail(function(data) {
			    alert( "couldn't log");
			  })
			  .always(function(data) {
			    // alert( "finished");
			});
		// }
	}
}

export default new Vuex.Store({
	state,
	mutations,
	middlewares: [persistence]
})