import Vue from 'vue'
import Revue from 'revue'
import {createStore} from 'redux'
// create the logic how you would update the genomes
import genomes from '../reducers/genomes'
// create some redux actions
import actions from '../actions'

// create a redux store
const reduxStore = createStore(genomes)
// binding the store to Vue instance, actions are optional
const store = new Revue(Vue, reduxStore, actions)
// expose the store for your component to use
export default store
