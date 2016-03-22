export function getGenomes(state) {
	var genomes = [];
	for(var i = 0; i < 7; i++){
		if(i < 2){
			genomes[i] = state.parents[i];
		}else if(i < 7){
			genomes[i] = state.children[i-2];
		}
	}
	return genomes;
}

export function isPlaying (state){
	return state.audioplayer.playing;
}