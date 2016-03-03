const dummygenome = 'lakjdflkaldkfsj';
const defaultState = {
  parents: [dummygenome, dummygenome],
  children: [
    dummygenome,
    dummygenome,
    dummygenome,
    dummygenome,
    dummygenome
  ],
  selected: 0,
  newparents: [0, 0],
  audioplayer: {index: 0, playing: false}
};

export default function todos(state = defaultState, action) {
  let newstate = Object.assign({}, state); // sloppily copying the old state here, so we never mutate it
  switch (action.type) {
  case 'PLAY_GENOME':
    newstate.audioPlayer = {index: action.index, playing: true};
    return newstate;
  case 'SELECT_GENOME':
    newstate.selected = action.index;
    return newstate;
  case 'CHOOSE_PARENT':
    newstate.newparents[action.parentindex] = action.childindex;
    return newstate;
  case 'BREED_GENOMES':
    newstate.genomes = breed(newstate.genomes);
    newstate.audioPlayer = {index: 0, playing: false};
    return newstate;
  default:
    return newstate;
  }
}

function breed(genomes) {
  //todo
  return genomes;
}
