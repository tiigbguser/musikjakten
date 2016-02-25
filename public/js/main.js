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
		saved: true
	},

	ready:function(){
		this.getSettings();
	},

	methods:{
		fieldChange: function(){
			this.saved = false;

		},
		getSettings: function(){
			this.$http.get('/json/settings', function(settings){
				this.profile = settings;
			})
		},
		saveSettings: function(){
			this.$http.post('json/settings/save', this.profile);
			this.saved = true;
		}
	}
})