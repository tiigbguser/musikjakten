export function select(store, index){
	store.dispatch('SELECT', index);
}

export function randomize(store, index){
	store.dispatch('RANDOM', index);
}

export function randomizeAll(store){
	for(var i = 0; i < 7; i++){
		store.dispatch('RANDOM', i);
	}
}

export function mutate(store, index){
	store.dispatch('MUTATE', index);
}

export function crossBreed(store, index1, index2){
	store.dispatch('CROSSBREED', index1, index2);
}

export function increment(store){
	store.dispatch('INC');
}

export function initialize(store){
	store.dispatch('INITIALIZE');
}