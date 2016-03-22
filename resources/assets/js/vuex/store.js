import Vue from '../vendor/vue'
import Vuex from '../vendor/vuex'

Vue.use(Vuex);

const dummygenome1 = [1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1]
const dummygenome2 = [1.0,0.5,0.1,0.7,0.2,0.9,0.0,0.4,1.0,0.1]

const state = {
	parents: [dummygenome1, dummygenome2],
	children: [
		[],
		[],
		[],
		[],
		[]
		],
	selected: 0,
	newparents: [0, 0],
	audioplayer: {index: 0, playing: false}
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


const mutations = {
	SELECT (state, index){
		state.selected = index;
	},
	INITIALIZE (state){
		state.parents.$set(0, []);
	 	state.parents.$set(1, []);
		for(var i=0;i<5;i++) {
			state.children.$set(i, []);
		}

		state.audioplayer.index=0;
		state.audioplayer.playing = false;

		state.selected = 0;
		state.newparents = [0,0];
	},
	SETGENOME(state, genome, index){
		if(index < 2){
			state.parents.$set(index, genome);
		}else{
			state.children.$set(index-2, genome);
		}
	},
	RANDOM (state, index){
		var genome = getGenome(state, index);
		for(var i=0;i<10;i++) {
		 	genome.$set(i ,Math.random());
		}
	},
	MUTATE (state, index){
		var genome = getGenome(state, index);
		const mutate_prob=0.5;
		const mutate_range=0.2;

		var counter = 0;
		for (var i=0;i<genome.length;i++)
		{

			if (Math.random()<mutate_prob)
			{
				counter++;
				var value = genome[i];
				value += 2*mutate_range*Math.random()-mutate_range;
				if (value>1){
					 // value=1; // clip
					 value=-(value-1)+1; // spegla
				}else if (value<0){
					 // value=0; // clip
					 value= -value; // spegla
				}

				genome.$set(i, value);
				console.log("changed at index " + i);
			}
		}
		console.log("changed " + counter + " positions");
	},
	CROSSBREED (state, index1, index2){
		var mother = getGenome(state, index1);
		var father = getGenome(state, index2);

		const jump_prob = 0.2;

		state.parents.$set(0, mother);
		state.parents.$set(1, father);

		console.log("mother: " + mother);
		console.log("father: " + father);



		for(var childIndex = 0; childIndex < state.children.length; childIndex++){
			var newChild = [];
			var sourceSide = Math.floor((Math.random() * 2));
			
			var counter = 0;

			for(var i = 0; i < mother.length; i++){
				newChild[i] = state.parents[sourceSide][i]

				if(Math.random() < jump_prob){
					sourceSide++;
					sourceSide %= 2;
					counter++;
				}
			}

			state.children.$set(childIndex, newChild);
		}

		// console.log("child: " + newChild);
		// console.log("nr if jumps: " + counter);
	}

}

export default new Vuex.Store({
	state,
	mutations
})