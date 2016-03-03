var Vue = require('vue');
Vue.use(require('vue-resource'));

//Make sure we send along a token in the ajax requests
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

new Vue({
  el: '#hello',

  data:{
    logs:[
      {music_data: 'test',
      name: 'test'},
      ],
  },

  // computed:{

  // },

  ready: function(){
    this.fetchLogs();
  },

  methods: {
    fetchLogs: function(){
      this.$http.get('/json/logs', function(logs){
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

new Vue({
  el: '#settings',

  data:{
    profile: '',
    questions: '',
    saved: true,
    saveFailed: false,
    saveSuccess: false
  },

  ready:function(){
    this.getSettings();
  },


  methods:{
    getQuestion: function(key){
      console.log(key);
      if(this.questions[key]){
        return this.questions[key];
      }else return '';
    },
    fieldChange: function(){
      this.saved = false;
      this.saveFailed = false;
      this.saveSuccess = false;

    },
    getSettings: function(){
      this.$http.get('/json/settings', function(settings){
        console.log(settings);
        this.profile = settings.user;
        this.questions = settings.questions;
      });
    },
    saveSettings: function(){
      this.$http.post('json/settings/save', this.profile).then(
        function(response){
          //success
          this.saved = true;
          this.saveSuccess = true;
        }, function(response){
          //fail
          this.saveFailed = true;
        });
    }
      


  }
});

Vue.directive('radio', {
  twoWay: true,
  bind: function() {
      var self = this;
      var btns = $(self.el).find('.btn');
      btns.each(function() {
          $(this).on('click', function() {
              var v = $(this).find('input').get(0).value
              self.set(v);
          })
      });
  },
  update: function() {
      var value = this._watcher.value;
      if (value) {
          this.set(value);
          var btns = $(this.el).find('.btn')
          btns.each(function() {
              $(this).removeClass('active');
              var v = $(this).find('input').get(0).value;

              if (v === value) {
                  $(this).addClass('active');
              }
          });
      } else {
          var input = $(this.el).find('.active input').get(0);
          if (input) {
              this.set(input.value);
          }
      }
  }
})
