new Vue({
	el: '#hello',

	data:{
		logs:[
			{music_data: 'test',
			name: 'test'}
			]
	},

	ready: function(){
		this.fetchLogs();
	},

	methods: {
		fetchLogs: function(){
			this.$http.get('/json/logs', function(logs){
				this.$set('logs', logs);
			});
		}
	}
})