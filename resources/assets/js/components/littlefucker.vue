<template>
  <div class="{{isActive?'bg-success':'bg-info'}}" v-on:click="select(index)">
    <p>{{"index: " + index}}</p>
    <p>{{"currentlySelected: " + currentlySelected}}</p>
    <p>{{"isActive: " + isActive}}</p>
    <p>{{"myGenome: " + myGenome}}</p>
    <genomepic :genome="myGenome" :is-active="isActive"></genomepic>
    <button v-on:click="mutate(index)"> mutera mig</button>
    <button v-on:click="randomize(index)"> slumpa mig</button>
  </div>
  
</template>

<script>
  import {getGenomes} from '../vuex/getters'
  import * as actions from '../vuex/actions'
  module.exports = {
    props: ['index'], 
    data: function () {
      return {
      }
    },
    vuex: {
      getters: {
        currentlySelected: function(state) {
          return state.selected;
        },
        getGenomes
      },
      actions
    },
    computed: {
      isActive(){
        return this.index === this.currentlySelected;
      },
      myGenome(){
        // return [1,2,3,4,5];
        return (this.getGenomes)[this.index];
      }
    },
    ready: function(){
    },
    components: {
      'genomepic' : require('./genomepic.vue')
    }
  }
</script>