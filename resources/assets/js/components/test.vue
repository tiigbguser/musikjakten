<template>
  <pre id="hejhopp">
<!--     {{state.parents[0] }}
    </br>
    {{state.parents[1] }} -->
  </pre>
  <button v-on:click="initialize" > initialize</button>
  <button v-on:click="randomizeAll" > randomize</button>
  <button v-on:click="crossBreed(0, 1)" > crossbreed</button>
  <hr>
  <!-- <button v-on:click="mutate(0)" > mutate 0</button>
  <button v-on:click="mutate(1)" > mutate 1</button> -->
  <div v-for="parent in state.parents" track-by="$index">
    <!-- <p>{{$index  + "   ___   " +  parent}}</p> -->
    <littlefucker :index="$index"></littlefucker>
  </div>
  <div v-for="child in state.children" track-by="$index">
    <littlefucker :index="$index+2"></littlefucker>
  </div>
</template>

<script>
import * as actions from '../vuex/actions'
  module.exports = {
    data: function () {
      return {
        // log: 'bajskorv'
      }
    },
    vuex: {
      getters: {
        // count: function(state){
        //   return state.count;
        // },
        // a state getter function, which will
        // bind `store.state.count` on the component as `this.count`
        state: function (state) {
          // console.log('selected');
          if(state.selected < 2){
            for(var i=0;i<10;i++) {
              genome[i]=state.parents[state.selected][i];
            }
          }else{
            for(var i=0;i<10;i++) {
              genome[i]=state.children[state.selected-2][i];
            }
          }

          return state;
        }
      },
      actions
    },
    components: {
      'littlefucker' : require('./littlefucker.vue')
    }
  }
</script>