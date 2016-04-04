<template>
  <button class="btn btn-primary" v-on:click="initialize" > initialize</button>
  <button class="btn btn-primary" v-on:click="randomizeAll" > randomize</button>
  <button class="btn btn-primary" v-on:click="crossBreed(0, 1)" > crossbreed</button>
  <hr>
  <!-- <button v-on:click="mutate(0)" > mutate 0</button>
  <button v-on:click="mutate(1)" > mutate 1</button> -->
  <div class="col-md-6" v-for="parent in state.parents" track-by="$index">
    <!-- <p>{{$index  + "   ___   " +  parent}}</p> -->
    <genome-box v-if="parent.genome.length > 0" :index="$index"></genome-box>
  </div>
  <div class="col-md-2" v-for="child in state.children" track-by="$index">
    <genome-box v-if="child.genome.length > 0" :index="$index+2"></genome-box>
  </div>
</template>

<script>
// import {getGenomes} from '../vuex/getters'
import * as actions from '../vuex/actions'
  module.exports = {
    data: function () {
      return {
        debug: 'debug'
      }
    },
    vuex: {
      getters: {
        state: function (state) {
          // console.log('selected');

          //this shit writes to the global genome. Very questionable procedure.
          // console.log('bajs' + (this.getGenomes)[0]);
          // if((this.getGenomes)[state.selected].genome.length > 10){
            if(state.selected < 2){
              for(var i=0;i<10;i++) {
                genome[i]=state.parents[state.selected].genome[i];
              }
            }else{
              for(var i=0;i<10;i++) {
                genome[i]=state.children[state.selected-2].genome[i];
              }
            }
          // }

          return state;
        }
      },
      actions
    },
    components: {
      'genomeBox' : require('./genomeBox.vue')
    }
  }
</script>