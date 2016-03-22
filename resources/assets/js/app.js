

import Vue from './vendor/vue'
import VueResource from './vendor/vue-resource'
import store from './vuex/store'

var test = require('./components/test.vue')


Vue.use(VueResource);

// const state = {
//   count: 0
// }

// const mutations = {
//   INCREMENT (state){
//     state.count++;
//   }
// }

// const store = new Vuex.Store({
//   state,
//   mutations
// });

//Make sure we send along a token in the ajax requests
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');


var app = new Vue({
  el: '#app',
  store,
  components: {
    test
  }
});

new Vue({
  el: '#hello',

  // data:{
  //   logs:[
  //     {music_data: 'test',
  //     name: 'test'},
  //     ],
  //   genome: ''
  // },

  data: {
    // return {
      music_data: 'test',
      // todos: this.$select('genomes')
      //=> subscribe state.todos to vm.todos
      // if prop is not in top level
      // do this.$select('todos as path.to.todos')
    // }
  },

  ready: function(){
    this.fetchLogs();
  },

  methods: {
    // test: function(){
    //   store.dispatch({type: 'PLAY_GENOME', this.genome});
    // },
    fetchLogs: function(){
      this.$http.get('/json/logs').then(function(logs){
        // this.$set('logs', logs);
        this.logs = logs;
      });

      for(var i=0;i<10;i++) {
          genome[i]=Math.random();
      }
    },
    newGenome: function(){
      for(var i=0;i<10;i++) {
          genome[i]=Math.random();
      }
    },
  }
});