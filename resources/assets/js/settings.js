import Vue from './vendor/vue'
import VueResource from './vendor/vue-resource'
// import Store from './store/store'

// import test from './components/test'
// var test = require('./components/test.vue')

// Vue.use(Vuex);
Vue.use(VueResource);



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
      
      if(this.questions[key]){
        console.log(this.questions[key].question);
        return this.questions[key].question;
      }else{
        console.log(key);
        return key;
      }
    },
    fieldChange: function(){
      this.saved = false;
      this.saveFailed = false;
      this.saveSuccess = false;

    },
    getSettings: function(){
      this.$http.get('/json/settings').then(function(settings){
        console.log(settings.data);
        this.profile = settings.data.user;
        this.questions = settings.data.questions;
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
});