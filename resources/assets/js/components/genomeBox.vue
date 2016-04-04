<template>
  <div class="{{isActive?'bg-success':'bg-info'}}" v-on:click="select(index)">
<!--     <p>{{"index: " + index}}</p>
    <p>{{"currentlySelected: " + currentlySelected}}</p>
    <p>{{"isActive: " + isActive}}</p>
    <p>{{"myGenome: " + myGenome}}</p> -->
    <genomepic :genome="myGenome" :is-active="isActive"></genomepic>
    <p>{{myGenome.name}}</p>
    <button class="btn btn-primary" v-on:click.stop="mutate(index)"> mutera mig</button>
    <button class="btn btn-primary" v-on:click.stop="randomize(index)"> slumpa mig</button>

    <button class="btn btn-primary" v-if="!showSaveField && myGenome.name ===''" v-on:click.stop="showSaveField=true">spara mig</button>
    <div v-if="showSaveField" class="input-group">
      <input type="text" v-model="name" class="form-control" placeholder="Välj namn" autofocus />
      <span class="input-group-btn">
        <button v-on:click.stop="save" class="btn btn-primary" type="button">Go!</button>
      </span>
    </div><!-- /input-group -->
  </div>
  
</template>

<script>
  import {getGenomes} from '../vuex/getters'
  import * as actions from '../vuex/actions'
  module.exports = {
    props: ['index'], 
    data: function () {
      return {
        name:'',
        showSaveField: false,
      }
    },
    methods: {
      save(){
        this.saveGenome(this.index, this.name);
        this.showSaveField = false;
        this.name = '';
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