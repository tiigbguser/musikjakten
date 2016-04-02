var Vue = require('./vendor/vue');

Vue.use(require('./vendor/vue-resource'));


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
      logs: 'default',
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
      this.$http.get('/json/logs').then(function(data){
        // this.$set('logs', logs);
        this.logs = data.data;
      });
    },
  }
});