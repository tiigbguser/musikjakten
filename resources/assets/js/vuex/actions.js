export function select(store, index){
	store.dispatch('SELECT', index);
}

export function randomize(store, index){
	store.dispatch('RANDOM', index);
}

export function loadAsParent1(store, genome){
	store.dispatch('LOADGENOMEINTO', genome, 0);
}
export function loadAsParent2(store, genome){
	store.dispatch('LOADGENOMEINTO', genome, 1);
}

export function saveGenome(store, index, name){
	store.dispatch('SAVE', index, name);
}

export function randomizeAll(store){
	store.dispatch('RANDOMIZEALL');
}

export function mutate(store, index){
	store.dispatch('MUTATE', index);
}

export function crossBreed(store, index1, index2){
	// console.log(store);
	store.dispatch('CROSSBREED', index1, index2);
}

export function initialize(store){
	store.dispatch('INITIALIZE');
}