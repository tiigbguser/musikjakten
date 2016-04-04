<template>
	<h3>My genomes!</h3>
	<ul>
		<li v-for="genome in myGenomes">
			<list-item :genome="genome"></list-item>
		</li>
	</ul>
	<h3>Other's genomes!</h3>
	<ul>
		<li v-for="genome in othersGenomes">
			<list-item :genome="genome"></list-item>
		</li>
	</ul>
	<pre>{{$data | json}}</pre>
</template>

<script>
// import * as actions from '../vuex/actions'
module.exports = {
  data: function() {
  	return{
    	myGenomes: [1,2,3],
    	othersGenomes: [4,5,6],
    }
  },
  methods: {
    fetchOthers() {
      this.$http.get('/json/genome/others').then(function (data) {
        // this.$set('logs', logs);
        // console.log('fick en respons!' + data);
        this.othersGenomes = data.data;
      });
    },
    fetchMyself(){
    	this.$http.get('/json/genome/index').then(function (data) {
        // this.$set('logs', logs);
        // console.log('fick en respons!' + data);
        this.myGenomes = data.data;
      });
    }
  },
  ready: function ready() {
    this.fetchOthers();
    this.fetchMyself();
  },
  // vuex: {
  //   getters: {
  // 		}
  //   },
  //   // actions
  // },
  components: {
  	'listItem' : require('./listItem.vue')
  }
}
</script>