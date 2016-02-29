// create actionCreators yourself or use `redux-actions`
export function playGenome(index) {
  return {type: 'PLAY_GENOME', index};
}
export function selectGenome(index) {
  return {type: 'SELECT_GENOME', index};
}
export function chooseParent(parentindex, childindex) {
  return {type: 'CHOOSE_PARENT', parentindex, childindex};
}
export function breedGenomes(payload) {
  return {type: 'BREED_GENOMES', payload};
}
export function newGenomes(payload) {
  return {type: 'NEW_GENOMES', payload};
}
