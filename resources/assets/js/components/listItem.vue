<template>
	<p>{{genome.name}}</p>
	<button class="btn btn-primary" v-on:click="loadAsParent1(genome)" > load as parent 1</button>
	<button class="btn btn-primary" v-on:click="loadAsParent2(genome)" > load as parent 2</button>

</template>

<script>
import * as actions from '../vuex/actions'
module.exports = {

    props: ['genome'], 
    data: function () {
      return {
      }
    },
    vuex: {
      getters: {
      },
      actions
    },
    methods: {
    	// loadParent1(){
    	// 	this.genome = '';
    	// },
    	// loadParent2(){
    	// 	this.genome = '';
    	// }
    }
}

</script>