

// import Vue from './vendor/vue'
var Vue = require('./vendor/vue');

// import VueResource from './vendor/vue-resource'

import store from './vuex/store'
// var store = require('./vuex/store');

var test = require('./components/test.vue')


// Vue.use(VueResource);
Vue.use(require('./vendor/vue-resource'));


//Make sure we send along a token in the ajax requests
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value') }
});
// Vue.http.get('/json/logs');


var app = new Vue({
  el: '#app',
  store,
  components: {
    test
  }
});